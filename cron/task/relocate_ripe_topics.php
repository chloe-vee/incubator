<?php

/**
 * Cron task to move tasks from one board to another at a certain age.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\cron\task;

use phpbb\cron\task;

/**
 * Cron.
 */
class relocate_ripe_topics extends \phpbb\cron\task\base
{
    /* @var \phpbb\config\config */
    protected $config;

    /* @var \phpbb\db\driver\driver_interface */
    protected $db;

    /* @var string */
    protected $root;

    /* @var int */
    public $a_day = 86400;

    /**
     * Constructor.
     *
     * @param \phpbb\config\config              $config The config
     * @param \phpbb\db\driver\driver_interface $db     The db connection
     * @param ?string                           $root   The phpBB root path
     */
    public function __construct(
        \phpbb\config\config $config,
        \phpbb\db\driver\driver_interface $db,
        ?string $root = null
    ) {
        $this->config = $config;
        $this->db = $db;
        $this->root = $root;
    }

    /**
     * Run the cron job.
     *
     * @return null
     */
    public function run()
    {
        $f_id = $this->config["incubator_from_forum"];
        $t_id = $this->config["incubator_to_forum"];
        $days = $this->config["incubator_days"];
        $this->relocate($f_id, $t_id, $days);

        $this->config->set("relocate_ripe_topics_last_gc", time());
    }

    /**
     * Move ripe topics from one forum to another.
     *
     * @param int $f_id Forum to move old posts from
     * @param int $t_id Forum to move old posts to
     * @param int $days Number of days until the posts are ripe for moving
     *
     * @return null
     */
    public function relocate(int $f_id, int $t_id, int $days): void
    {
        $date = time() - ($days * $this->a_day);

        $sql = "
            SELECT topic_id
            FROM " . TOPICS_TABLE . "
            WHERE
                forum_id = $f_id
                AND topic_time < $date
                AND topic_type = " . POST_NORMAL . "
        ";

        $result = $this->db->sql_query($sql);
        $topics = [];

        while ($row = $this->db->sql_fetchrow($result)) {
            $topics[] = $row['topic_id'];
        }

        $this->db->sql_freeresult($result);
        $this->move_topics($topics, $t_id);
    }

    /**
     * Call the move_topics() phpBB function
     * from functions_admin.php.
     * (Mostly here for testing.)
     *
     * @param array $topic_ids Topic IDs to move
     * @param int   $forum_id  Forum ID to move topics to
     *
     * @return null
     */
    protected function move_topics($topic_ids, $forum_id): void
    {
        include_once "{$this->root}/includes/functions_admin.php";
        move_topics($topic_ids, $forum_id);
    }

    /**
     * This task can run if it has all required config values.
     *
     * @return bool
     */
    public function is_runnable(): bool
    {
        $runnable = (
            !!$this->config["incubator_from_forum"] &&
            !!$this->config["incubator_to_forum"] &&
            !!$this->config["incubator_days"]
        );
        return $runnable;
    }

    /**
     * The cron should run according to the config frequency.
     *
     * @return bool
     */
    public function should_run(): bool
    {
        $last = (int) $this->config["relocate_ripe_topics_last_gc"];
        $freq = (int) $this->config["relocate_ripe_topics_gc"];

        $run = ( !$last || ($last <= (time() - $freq)) );
        return $run;
    }
}
