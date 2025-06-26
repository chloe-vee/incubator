<?php

namespace ra\incubator\tests;

use PHPUnit\Framework\TestCase;

final class helpers_test extends TestCase
{
    /**
     * Should do something.
     */
    public function test_joinpaths(): void
    {
        $path = joinpaths("a", "b", "c");
        $this->assertSame($path, str_replace("-", DIRECTORY_SEPARATOR, "a-b-c"));
    }

    /**
     * The keys_exist() function should return true if all strings in $keys
     * exist as keys in $dict.
     *
     * @dataProvider keys_exist_provider
     */
    public function test_keys_exist($keys, $expected): void
    {
        $dict = ["a" => 1, "b" => 2, "c" => 3];
        $result = keys_exist($keys, $dict);
        $this->assertSame($result, $expected);
    }

    /**
     * GIVEN: a fixture file
     * WHEN: fixture_sql() is called with the name of that file
     * THEN: the file contents should be returned
     */
    public function test_fixture_sql(): void
    {
        $sql = fixture_sql("data-topics");
        $this->assertStringContainsString("INSERT INTO phpbb_topics", $sql);
    }

    /**
     * WHEN: fixture_sql() is called with the name of that file that does not exist
     * THEN: it should throw an exception
     */
    public function test_fixture_sql_no_such_file(): void
    {
        $this->expectException(\ErrorException::class);
        fixture_sql("xxx");
    }

    /**
     * Provide test cases for test_keys_exist().
     */
    public static function keys_exist_provider()
    {
        return [
            "all" => [["a", "b", "c"], true],
            "none" => [["d", "e", "f"], false],
            "some" => [["a", "b"], true],
            "mixed" => [["a", "b", "d"], false],
            "empty" => [[], true],
        ];
    }
}
