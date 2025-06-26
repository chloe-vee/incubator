<?php

namespace ra\incubator\tests\cron\task;

use PHPUnit\Framework\TestCase;
use ra\incubator\cron\task\migrate_posts;
use ra\incubator\tests\DBTestCase;

final class migrate_posts_test extends DBTestCase
{
    // protected \PDO $db;

    /**
     * Set up test database.
     */
    public function initDB(): void
    {
        $this->db->exec(fixture_sql("table-topics"));
        $this->db->exec(fixture_sql("data-topics"));
    }

    /**
     * Class instantiate without error.
     */
    public function testMigratePostsByAge(): void
    {
        $task = new migrate_posts(
            $this->createStub('\phpbb\config\config'),
            $this->createStub('\phpbb\db\driver\driver_interface'),
        );
        $this->assertInstanceOf('ra\incubator\cron\task\migrate_posts', $task);
    }

    /**
     * The .migrate() function should...
     */
    public function testMigrate(): void
    {
        $from_forum = 2;
        $to_forum = 3;
        $days = 1;

        $db = $this->createMock(\phpbb\db\driver\driver_interface::class);

        $db->method('sql_query')
            ->willReturnCallback(
                function (string $query) {
                    $this->db->exec($query);
                }
            );

        $task = new migrate_posts($this->createStub('\phpbb\config\config'), $db);
        $task->migrate($from_forum, $to_forum, $days);

        $stmt = $this->db->query("SELECT forum_id FROM phpbb_topics");
        $id = $stmt->fetchColumn();

        $this->assertSame($to_forum, $id);
    }

    /**
     * The .run() function should...
     */
    public function testRun(): void
    {
        $task = new migrate_posts(
            $this->createStub('\phpbb\config\config'),
            $this->createStub('\phpbb\db\driver\driver_interface'),
        );
        $task->run();
        $this->assertInstanceOf('ra\incubator\cron\task\migrate_posts', $task);
    }
}
