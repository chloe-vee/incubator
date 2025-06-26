<?php

namespace ra\incubator\tests\acp;

use ra\incubator\acp\main_info;
use PHPUnit\Framework\TestCase;

final class main_info_test extends TestCase
{
    /**
     * Class should instantiate without error.
     */
    public function testMainInfo(): void
    {
        $info = new main_info();
        $this->assertInstanceOf('ra\incubator\acp\main_info', $info);
    }

    /**
     * .module() method should return an array of module info.
     */
    public function testModule(): void
    {
        $info = new main_info();
        $module = $info->module();

        $this->assertSame('\ra\incubator\acp\main_info', $module["filename"]);

        $this->assertTrue(keys_exist(["filename", "title", "modes"], $module));
        $this->assertArrayHasKey("settings", $module["modes"]);
        $this->assertTrue(
            keys_exist(["title", "auth", "cat"], $module["modes"]["settings"]),
        );
    }
}
