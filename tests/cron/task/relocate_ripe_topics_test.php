<?php

namespace ra\incubator\tests\cron\task;

use phpbb\config\config;
use PHPUnit\Framework\TestCase;
use ra\incubator\cron\task\relocate_ripe_topics;
use ra\incubator\tests\DBTestCase;

class relocate_ripe_topics_test extends DBTestCase
{
    protected $f_id = 2;
    protected $t_id = 3;
    protected $days = 1;

    /**
     * Set up test database.
     */
    public function initDB(): void
    {
        $this->db->exec(fixture_sql("table-topics"));
        $this->db->exec(fixture_sql("data-topics"));
    }

    /**
     * Topic ids from the DB for a particular forum ID.
     *
     * @return array
     */
    protected function topic_ids($forum_id): array {
        $stmt = $this->db->query(
            "SELECT topic_id FROM phpbb_topics WHERE forum_id = {$this->f_id}",
        );
        return $this->fetchColumnValues($stmt);
    }

    /**
     * Class instantiate without error.
     */
    public function testConstructor(): void
    {
        $task = new relocate_ripe_topics(
            $this->createStub('\phpbb\config\config'),
            $this->createStub('\phpbb\db\driver\driver_interface'),
            STUBS_ROOT,
        );

        $this->assertInstanceOf(
            'ra\incubator\cron\task\relocate_ripe_topics',
            $task,
        );
    }

    /**
     * The .relocate() method should...
     */
    public function testRelocate(): void
    {
        // get the current topics that are on the from forum
        // (since $days is 1 old, it's safe to assume they're all ripe)
        $topics = $this->topic_ids($this->f_id);

        // create a task object with the move_topics() method mocked
        $task = $this->getMockBuilder(relocate_ripe_topics::class)
                     ->setConstructorArgs(
                         [new config([]), $this->mockDB, STUBS_ROOT],
                     )
                     ->onlyMethods(["move_topics"])
                     ->getMock();

        $task->expects($spy = $this->once())
            ->method("move_topics")
            ->with($topics, $this->t_id);

        $task->relocate($this->f_id, $this->t_id, $this->days);
    }

    /**
     * The ->run() function call the ->relocate() method with the values from
     * the config.
     */
    public function testRun(): void
    {
        // get the current topics that are on the from forum
        // (since $this->days is 1 old, it's safe to assume they're all ripe)
        $topics = $this->topic_ids($this->f_id);

        // prepare the config
        $config = new config(
            [
                "incubator_from_forum" => $this->f_id,
                "incubator_to_forum" => $this->t_id,
                "incubator_days" => $this->days,
            ],
        );

        $now = time();

        // create a task object with the ->move_topics() method mocked
        $task = $this->getMockBuilder(relocate_ripe_topics::class)
                     ->setConstructorArgs([$config, $this->mockDB, STUBS_ROOT])
                     ->onlyMethods(["move_topics"])
                     ->getMock();

        $task->expects($spy = $this->once())
            ->method("move_topics")
            ->with($topics, $this->t_id);

        // call the run method
        $task->run();

        // make sure the last run timestamp is set
        $this->assertIsInt($config["relocate_ripe_topics_last_gc"]);
        $this->assertGreaterThanOrEqual(
            $config["relocate_ripe_topics_last_gc"],
            $now,
        );
    }

    /**
     * The ->should_run() method should return true if it was last run prior
     * to the last 24 hours.
     *
     * @dataProvider dataShouldRun
     */
    public function testShouldRun($last, $expected): void
    {
        $config = new config(
            [
                "relocate_ripe_topics_gc" => A_DAY,
                "relocate_ripe_topics_last_gc" => $last
            ]
        );

        $task = new relocate_ripe_topics($config, $this->mockDB, STUBS_ROOT);
        $do_it = $task->should_run();

        $this->assertSame($expected, $do_it);
    }

    /**
     * Test cases for testShouldRun().
     *
     * @return array
     */
    public static function dataShouldRun(): array
    {
        return [
            "last run before yesterday" => [(time() - A_DAY - 1000), true],
            "last run yesterday" => [(time() - A_DAY), true],
            "last run since yesterday" => [(time() - A_DAY + 1000), false],
        ];
    }
}
