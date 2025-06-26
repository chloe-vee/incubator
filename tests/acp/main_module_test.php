<?php

namespace ra\incubator\tests\acp;

require_stub("functions.php");
require_stub("admin.php");

use phpbb\json_response;
use phpbb\container;
use ra\incubator\acp\main_module;
use ra\incubator\tests\DBTestCase;

final class main_module_test extends DBTestCase
{
    /**
     * Set up test database.
     */
    public function initDB(): void
    {
        $this->db->exec(fixture_sql("table-topics"));
        $this->db->exec(fixture_sql("data-topics"));

        $this->db->exec(fixture_sql("table-forums"));
        $this->db->exec(fixture_sql("data-forums"));

        $this->db->exec(fixture_sql("table-ra"));
        $this->db->exec(fixture_sql("data-ra"));
    }

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
                "dbal.conn" => $this->mockDB,
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

        $user->expects($this->once())
            ->method("lang")
            ->with("ACP_INCUBATOR_SETTINGS")
            ->willReturn("My Extension");

        // $template->expects($this->once())
        //     ->method("assign_vars");

        $module = new main_module();
        $module->main();

        $this->assertSame("My Extension", $module->page_title);
        $this->assertSame("acp_settings", $module->tpl_name);
    }

    /**
     * .delete() method remove the row from the database.
     */
    public function testDeleteSuccess(): void
    {
        global $phpbb_container;
        $phpbb_container = $this->container();

        $request = $phpbb_container->get("request");
        $db      = $phpbb_container->get("dbal.conn");

        $f_id = 2;
        $t_id = 3;
        $days = 1;

        $vars = ["f_id" => $f_id, "t_id" => $t_id];

        $request->method("variable")
            ->willReturnCallback(fn($k) => $vars[$k]);

        $module = new main_module();
        $module->delete();

        $result = $this->db->query(
            "
                SELECT *
                FROM phpbb_ra_incubator
                WHERE
                    from_forum_id = $f_id
                    AND to_forum_id = $t_id
            "
        );

        $this->assertInstanceOf('\phpbb\json_response', $module->response);
        $this->assertTrue($module->response->data["success"]);

        $rows = $result->fetchAll();
        $this->assertCount(0, $rows);
    }

    /**
     * .delete() method should respond with a json error message if the
     * required arguments are not present in the request.
     */
    public function testDeleteFail(): void
    {
        global $phpbb_container;
        $phpbb_container = $this->container();

        $request = $phpbb_container->get("request");

        $request->method("variable")
            ->willReturn(null);

        $module = new main_module();
        $module->delete();

        $this->assertInstanceOf('\phpbb\json_response', $module->response);
        $this->assertFalse($module->response->data["success"]);
    }

    /**
     * The .get_migrations() function should return a list of existing migrations.
     *
     * @return null
     */
    public function testGetMigrations(): void
    {
        global $phpbb_container;
        $phpbb_container = $this->container();

        $f_id = 2;
        $t_id = 3;
        $days = 1;

        $module = new main_module();

        $migrations = $module->get_migrations();
        $row        = $migrations[0];

        $this->assertCount(1, $migrations);
        $this->assertSame($f_id, $row["from_forum_id"]);
        $this->assertSame($t_id, $row["to_forum_id"]);
        $this->assertSame($days, $row["days"]);
    }
}
