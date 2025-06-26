<?php

namespace ra\incubator\tests;

use PHPUnit\Framework\TestCase;

/**
 * A teest case.
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
                    $statement = $this->db->query($sql);
                    $rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

                    $result = $this->createMock('mysqli_result');
                    $result->method("fetch_all")->willReturn($rows);

                    return $result;
                }
            );

        $this->initDB();
    }

    /**
     * Execute the SQL statements to create the schema and add data to the
     * database here.
     *
     * @return null
     */
    abstract protected function initDB(): void;
}
