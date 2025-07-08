<?php

namespace ra\incubator\tests;

use PHPUnit\Framework\TestCase;

/**
 * A test case.
 */
abstract class DBTestCase extends \PHPUnit\Framework\TestCase
{
    protected \PDO $db;
    protected $mockDB;

    /**
     * Initialize the memory DB.
     *
     * @return null
     */
    protected function setUp(): void
    {
        $this->db = new \PDO("sqlite::memory:");
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        $this->mockDB = $this->createMock(\phpbb\db\driver\driver_interface::class);

        $this->mockDB->method('sql_query')
            ->willReturnCallback(
                function (string $sql) {
                    return $this->db->query($sql);
                }
            );

        $this->mockDB->method('sql_fetchrow')
            ->willReturnCallback(
                function ($statement) {
                    return $statement->fetch();
                }
            );

        $this->initDB();
    }

    /**
     * All the values from a column.
     *
     * @return array
     */
    public function fetchColumnValues(\PDOStatement $statement): array
    {
        $values = [];
        while ($v = $statement->fetchColumn(0)) {
            $values[] = $v;
        }

        return $values;
    }

    /**
     * A string of $count comma-spearated "?" placeholders.
     *
     * @return string
     */
    public function placeholders(int $count): string
    {
        return join(", ", array_fill(0, $count, "?"));
    }

    /**
     * Execute the SQL statements to create the schema and add data to the
     * database here.
     *
     * @return null
     */
    abstract protected function initDB(): void;
}
