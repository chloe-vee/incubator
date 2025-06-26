<?php

/**
 * Admin Control Panel Module.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\acp;

use phpbb\json_response;

/**
 * Main module class.
 */
class main_module
{
    /* @var \phpbb\di\container_builder */
    public $container;

    /* @var \phpbb\template\template */
    public $template;

    /* @var \phpbb\db\driver\driver_interface */
    public $db;

    /* @var \phpbb\request\request */
    public $request;

    /* @var \phpbb\user */
    public $user;

    /* @var \phpbb\json_response */
    public $response;

    /* @var string */
    public $table_name = "phpbb_ra_incubator";

    /* @var string */
    public $u_action;

    /* @var string */
    public $tpl_name = "acp_settings";

    /* @var string */
    public $page_title;

    /**
     * Constructor.
     */
    public function __construct()
    {
        global $phpbb_container;

        $this->container = $phpbb_container;

        $this->user = $phpbb_container->get("user");
        $this->template = $phpbb_container->get("template");
        $this->db = $phpbb_container->get("dbal.conn");
        $this->request = $phpbb_container->get("request");

        $this->response = new json_response();

        $this->page_title = $this->user->lang("ACP_INCUBATOR_SETTINGS");
        $this->user->add_lang("common");
    }

    /**
     * Main module.
     *
     * @param int    $id   id
     * @param string $mode mode
     *
     * @return null
     */
    public function main($id = null, $mode = null)
    {
        if ($this->request->is_ajax()) {
            $this->action = $this->request->variable("action", null);

            switch ($this->request->variable("action", null)) {
                case "delete":
                    $this->delete();
                    break;
                default:
                    $this->response->send(
                        [
                            "success" => false,
                            "message" => "Invaid action: {$this->action}",
                        ]
                    );
                    break;
            }

            return $this->response;
        }

        // add a unique security key to the form
        add_form_key("ra_incubator_settings");

        // // submit the form?
        // if ($request->is_set_post("submit")) {
        //     // ensure the submitted key is present and valid
        //     if (!check_form_key("ra_incubator_settings")) {
        //         trigger_error("FORM_INVALID");
        //     }

        //     // success! set to the submitted value
        //     $config->set(
        //         "ra_incubator_goodbye",
        //         $request->variable("ra_incubator_goodbye", 0),
        //     );

        //     // display a success message to the user
        //     // (not an error, not sure why the function is called that)
        //     trigger_error(
        //         $this->user->lang("ACP_INCUBATOR_SUCCESS")
        //         . adm_back_link($this->u_action)
        //     );
        // }

        $results = $this->get_migrations();

        $this->template->assign_var("U_ACTION", $this->u_action);

        foreach ($this->get_migrations() as $row) {
            $f_id = $row["from_forum_id"];
            $t_id = $row["to_forum_id"];

            $action = "{$this->u_action}&amp;f_id={$f_id}&amp;t_id=";

            $this->template->assign_block_vars(
                "rows",
                [
                   "F_ID" => $f_id,
                   "T_ID" => $t_id,
                   "F_OPTIONS" => make_forum_select($f_id),
                   "T_OPTIONS" => make_forum_select($t_id),
                   "DAYS" => $row["days"],
                   "U_DELETE" => "$action&amp;action=delete",
                ],
            );
        }
    }

    /**
     * Return a list of migrations;
     *
     * @return array
     */
    public function get_migrations(): array
    {
        $result = $this->db->sql_query("SELECT * FROM {$this->table_name}");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    /**
     * Delete a migration.
     *
     * @return null
     */
    public function delete(): void
    {
        $f_id = $this->request->variable("f_id", null);
        $t_id = $this->request->variable("t_id", null);

        if (!($f_id && $t_id)) {
            $this->response->send(
                [
                    "success" => false,
                    "message" => "You need both ids: f_id='$f_id', t_id='$t_id'",
                ]
            );
            return;
        }

        $sql = "
            DELETE FROM {$this->table_name}
            WHERE
                from_forum_id = $f_id
                AND to_forum_id = $t_id
        ";

        $this->db->sql_query($sql);

        $this->response = new json_response();
        $this->response->send(["success" => true]);
    }
}
