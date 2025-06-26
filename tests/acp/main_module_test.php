<?php

namespace ra\incubator\tests\acp;

require_stub("admin.php");
require_stub("functions.php");
require_stub("functions_acp.php");

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
     * The ->save() method should set the config values and display a success
     * message to the user.
     */
    public function testSave(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $config          = $phpbb_container->get("config");
        $request         = $phpbb_container->get("request");
        $user            = $phpbb_container->get("user");

        $request->expects($this->exactly(3))
                ->method("variable");

        $user->expects($this->once())
             ->method("lang")
             ->with("ACP_INCUBATOR_SUCCESS")
             ->willReturn("Success!");

        $module = new main_module();
        $module->save();

        $this->assertInstanceOf('\ra\incubator\acp\main_module', $module);
    }

    /**
     * The ->set_config() method should save the config values.
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
}
