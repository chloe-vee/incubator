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

    /* @var \phpbb\config\config */
    public $config;

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
        $this->request = $phpbb_container->get("request");
        $this->config = $phpbb_container->get("config");

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
        // add a unique security key to the form
        // add_form_key("ra_incubator_settings");

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

        $f_id = $this->config["incubator_from_forum"];
        $t_id = $this->config["incubator_to_forum"];
        $this->template->assign_vars(
            [
                "U_ACTION", $this->u_action,
                "DAYS", $this->config["incubator_days"],
                "F_OPTIONS" => make_forum_select($f_id),
                "T_OPTIONS" => make_forum_select($t_id),
            ],
        );
    }
}
