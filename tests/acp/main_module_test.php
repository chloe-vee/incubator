<?php

namespace ra\incubator\tests\acp;

require_stub("phpbb", "admin.php");
require_stub("includes", "functions.php");
require_stub("includes", "functions_acp.php");

use phpbb\config\config;
use phpbb\container;
use PHPUnit\Framework\TestCase;
use ra\incubator\acp\main_module;

final class main_module_test extends TestCase
{
    /**
     * A phpbb_container object fixture.
     *
     * @return phpbb\container
     */
    public function container(): \phpbb\container
    {
        return new container(
            [
                "user"      => $this->createMock('\phpbb\user'),
                "template"  => $this->createMock('\phpbb\template\template'),
                "request"   => $this->createMock('\phpbb\request\request'),
                "config"    => new config([]),
            ],
        );
    }

    /**
     * Class should instantiate without error
     * and set attributes.
     */
    public function testConstructor(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();

        $module = new main_module();

        $this->assertInstanceOf('\ra\incubator\acp\main_module', $module);

        $this->assertInstanceOf('\phpbb\config\config', $module->config);
        $this->assertInstanceOf('\phpbb\template\template', $module->template);
        $this->assertInstanceOf('\phpbb\user', $module->user);
    }

    /**
     * GIVEN: A GET request
     * WHEN: ->main() is called
     * THEN: it should call ->show()
     */
    public function testMainGet(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $request         = $phpbb_container->get("request");

        $request->expects($this->once())
            ->method("is_set_post")
            ->willReturn(false);

        $module = new main_module();
        $module->main();

        // TODO: how to test?

        $this->assertInstanceOf('\ra\incubator\acp\main_module', $module);
    }

    /**
     * GIVEN: A GET request
     * WHEN: ->main() is called
     * THEN: it should call ->save()
     */
    public function testMainSave(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $request         = $phpbb_container->get("request");

        $request->expects($this->once())
            ->method("is_set_post")
            ->willReturn(true);

        $module = new main_module();
        $module->main();

        // TODO: how to test?

        $this->assertInstanceOf('\ra\incubator\acp\main_module', $module);
    }

    /**
     * The .show() method should render the page without error.
     */
    public function testShow(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $template        = $phpbb_container->get("template");
        $user            = $phpbb_container->get("user");

        $user->expects($this->once())
            ->method("lang")
            ->with("ACP_INCUBATOR_SETTINGS")
            ->willReturn("Settings");

        $template->expects($this->once())
            ->method("assign_vars");

        $module = new main_module();
        $module->show();

        $this->assertSame("acp_settings", $module->tpl_name);
        $this->assertSame("Settings", $module->page_title);
    }

    /**
     * GIVEN: User input
     * WHEN: the ->save() method is called
     * THEN: the user should be shown a success message
     * AND: the config values should be saved.
     */
    public function testSaveSuccess(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $config          = $phpbb_container->get("config");
        $request         = $phpbb_container->get("request");
        $user            = $phpbb_container->get("user");

        $config["incubator_from_forum"] = 2;
        $config["incubator_to_forum"] = 3;
        $config["incubator_days"] = 5;
        $config["relocate_ripe_topics_gc"] = 120;

        $input = [
            "incubator_from_forum" => "4",
            "incubator_to_forum" => "5",
            "incubator_days" => "10",
            "relocate_ripe_topics_gc" => "60",
        ];

        $request->expects($this->exactly(8))
                ->method("variable")
                ->willReturnCallback(
                    function ($name, $default) use ($input) {
                        return $input[$name];
                    }
                );

        $user->expects($this->exactly(2))
             ->method("lang")
             ->with(
                 $this->logicalOr(
                     $this->equalTo("ACP_INCUBATOR_SETTINGS"),
                     $this->equalTo("ACP_INCUBATOR_SUCCESS"),
                 ),
             );

        $module = new main_module();
        $module->save();

        $this->assertSame($config["incubator_from_forum"], "4");
        $this->assertSame($config["incubator_to_forum"], "5");
        $this->assertSame($config["incubator_days"], "10");
        $this->assertSame($config["relocate_ripe_topics_gc"], "60");
    }

    /**
     * GIVEN: Invalid user input
     * WHEN: the ->save() method is called
     * THEN: the user should be shown the settings page again
     * AND: the config values should not be saved.
     */
    public function testSaveFail(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $config          = $phpbb_container->get("config");
        $request         = $phpbb_container->get("request");
        $user            = $phpbb_container->get("user");

        $config["incubator_from_forum"] = 2;
        $config["incubator_to_forum"] = 3;
        $config["incubator_days"] = 5;
        $config["relocate_ripe_topics_gc"] = 60;

        $request->expects($this->exactly(8))
                ->method("variable")
                ->willReturn("");

        $user->expects($this->once())
             ->method("lang")
             ->with("ACP_INCUBATOR_SETTINGS");

        $module = new main_module();
        $module->save();

        $this->assertInstanceOf('\ra\incubator\acp\main_module', $module);
        $this->assertSame($config["incubator_from_forum"], 2);
        $this->assertSame($config["incubator_to_forum"], 3);
        $this->assertSame($config["incubator_days"], 5);
        $this->assertSame($config["relocate_ripe_topics_gc"], 60);
    }

    /**
     * The ->validate() function should validate input.
     *
     * @dataProvider dataValidate
     */
     #[CoversFunction('main_module::validate')]
    public function testValidate($input, $expected): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $request         = $phpbb_container->get("request");

        $request->expects($this->exactly(4))
                ->method("variable")
                ->willReturnCallback(
                    function ($name, $default) use ($input) {
                        return $input[$name];
                    }
                );

        $module = new main_module();
        $errors = $module->validate();

        $this->assertEquals($expected, $errors);
    }

    /**
     * The ->set_config() method should save a config value.
     */
    public function testSetConfig(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $config          = $phpbb_container->get("config");
        $request         = $phpbb_container->get("request");

        $request->expects($this->once())
                ->method("variable")
                ->willReturnCallback(
                    function ($name, $default = null) {
                        return "xxx";
                    }
                );

        $module = new main_module();
        $module->set_config("abc");

        $this->assertSame("xxx", $config["abc"]);
    }

    /**
     * Provide test cases for testValidate().
     */
    public static function dataValidate()
    {
        return [
            "valid input" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "2",
                    "incubator_days" => "5",
                    "relocate_ripe_topics_gc" => "60",
                ],
                [],
            ],
            "surrounding whitespace" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "2",
                    "incubator_days" => " 5 ",
                    "relocate_ripe_topics_gc" => " 60 ",
                ],
                [],
            ],
            "same from and to forums" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "1",
                    "incubator_days" => "5",
                    "relocate_ripe_topics_gc" => "60",
                ],
                [
                    "incubator_from_forum" =>
                        "From and to forums cannot be the same.",
                    "incubator_to_forum" =>
                        "From and to forums cannot be the same.",
                ],
            ],
            "not a number" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "2",
                    "incubator_days" => "five",
                    "relocate_ripe_topics_gc" => "sixty",
                ],
                [
                    "incubator_days" => "Days must be a whole, positive number.",
                    "relocate_ripe_topics_gc" => "Cron frequency must be a whole, positive number.",
                ],
            ],
            "days not an int" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "2",
                    "incubator_days" => "5.2",
                    "relocate_ripe_topics_gc" => "60.5",
                ],
                [
                    "incubator_days" => "Days must be a whole, positive number.",
                    "relocate_ripe_topics_gc" => "Cron frequency must be a whole, positive number.",
                ],
            ],
            "days is negative" => [
                [
                    "incubator_from_forum" => "1",
                    "incubator_to_forum" => "2",
                    "incubator_days" => "-10",
                    "relocate_ripe_topics_gc" => "-60",
                ],
                [
                    "incubator_days" => "Days must be a whole, positive number.",
                    "relocate_ripe_topics_gc" => "Cron frequency must be a whole, positive number.",
                ],
            ],
            "empty input" => [
                [
                    "incubator_from_forum" => "",
                    "incubator_to_forum" => "",
                    "incubator_days" => "",
                    "relocate_ripe_topics_gc" => "",
                ],
                [
                    "incubator_from_forum" => "Required.",
                    "incubator_to_forum" => "Required.",
                    "incubator_days" => "Required.",
                    "relocate_ripe_topics_gc" => "Required.",
                ],
            ],
        ];
    }
}
