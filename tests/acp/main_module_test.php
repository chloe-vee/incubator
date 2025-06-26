<?php

namespace ra\incubator\tests\acp;

require_stub("functions.php");
require_stub("admin.php");

use phpbb\json_response;
use \phpbb\config\config;
use phpbb\container;
use ra\incubator\acp\main_module;
use PHPUnit\Framework\TestCase;

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
                "user"      => $this->createStub('\phpbb\user'),
                "template"  => $this->createStub('\phpbb\template\template'),
                "request"   => $this->createStub('\phpbb\request\request'),
                "config"    => new config([]),
            ],
        );
    }

    /**
     * Class should instantiate without error.
     */
    public function testConstructor(): void
    {
        global $phpbb_container;
        $phpbb_container = $this->container();

        $module = new main_module();

        $this->assertInstanceOf('\phpbb\request\request', $module->request);
    }

    /**
     * .main() method should ...
     */
    public function testMain(): void
    {
        global $phpbb_container;

        $phpbb_container = $this->container();
        $user            = $phpbb_container->get("user");
        $config          = $phpbb_container->get("config");

        $user->expects($this->once())
            ->method("lang")
            ->with("ACP_INCUBATOR_SETTINGS")
            ->willReturn("My Extension");

        // $config->expects($this->atLeastOnce())
        //     ->method("get");


        // $template->expects($this->once())
        //     ->method("assign_vars");

        $module = new main_module();
        $module->main();

        $this->assertSame("My Extension", $module->page_title);
        $this->assertSame("acp_settings", $module->tpl_name);
    }
}
