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
use phpbb\db\driver\driver_interface;

/**
 * Cron.
 */
class migrate_posts extends \phpbb\cron\task\base
{
    /* @var \phpbb\config\config */
    protected $config;

    /* @var \phpbb\db\driver\driver_interface */
    protected $db;

    /**
     * Constructor.
     *
     * @param \phpbb\config\config              $config The config
     * @param \phpbb\db\driver\driver_interface $db     The db connection
     */
    public function __construct(
        \phpbb\config\config $config,
        \phpbb\db\driver\driver_interface $db,
    ) {
        $this->config = $config;
        $this->db = $db;
    }

    /**
     * Run the cron job.
     *
     * @return null
     */
    public function run(): void
    {
        $from_forum_id = 2;
        $to_forum_id = 3;
        $days = 1;
    }

    /**
     * Migrate old posts from one forum to another.
     *
     * @param int $from_forum_id Forum to migrate old posts from
     * @param int $to_forum_id   Forum to migrate old posts to
     * @param int $days          Number of days old the post should to migrate
     *
     * @return null
     */
    public function migrate(int $from_forum_id, int $to_forum_id, int $days): void
    {
        $date = time() - ($days * 86400);

        $sql = "
            UPDATE
            " . TOPICS_TABLE . "
            SET forum_id = $to_forum_id
            WHERE
                forum_id = $from_forum_id
                AND topic_last_post_time < $date
        ";

        $result = $this->db->sql_query($sql);
    }
}
