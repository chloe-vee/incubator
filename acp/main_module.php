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

/**
 * Main module class.
 */
class main_module
{
    /**
     * Filename of the template located
     * in the adm/style/ directory.
     *
     * @var string
     */
    public $tpl_name = "acp_settings";

    /**
     * Language token that contains the HTML title text.
     *
     * @var string
     */
    protected $title_token = "ACP_INCUBATOR_SETTINGS";

    /**
     * Name of form validation key.
     *
     * @var string
     */
    protected $form_key_name = "ra_incubator_key";

    /**
     * HTML page title.
     *
     * @var string
     */
    public $page_title;

    /**
     * Action for the HTML form.
     * Set by whatever service calls the module.
     *
     * @var string
     */
    public $u_action;

    /**
     * The phpbb_container object,
     * obtained from global scope (unfortunately.)
     *
     * Provides access to all other dependent objects below.
     *
     * @var \phpbb\di\container_builder
     */
    protected $container;

    /**
     * Template object that handles rendering this module.
     *
     * @var \phpbb\template\template
     */
    public $template;

    /**
     * Config object where settings are stored.
     *
     * @var \phpbb\config\config
     */
    public $config;

    /**
     * Request object that contains information about the HTTP request sent to
     * access this module.
     *
     * @var \phpbb\request\request
     */
    public $request;

    /**
     * User object, to access language logic.
     *
     * @var \phpbb\user
     */
    public $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        global $phpbb_container;

        $this->container = $phpbb_container;

        $this->config = $phpbb_container->get("config");
        $this->request = $phpbb_container->get("request");
        $this->template = $phpbb_container->get("template");
        $this->user = $phpbb_container->get("user");

        // set up page
        $this->page_title = $this->user->lang($this->title_token);
        $this->user->add_lang_ext("ra/incubator", "common");
    }

    /**
     * Main method, called by phpbb.
     *
     * @param string $id   Module ID (namespace and classname)
     * @param string $mode Mode HTTP param and in module info. ("settings")
     *
     * @return null
     */
    public function main(?string $id = null, ?string $mode = null)
    {
        if ($this->request->is_set_post("submit")) {
            $this->save();
        } else {
            $this->show();
        }
    }

    /**
     * Show the settings page.
     *
     * @param bool $from_request Fill from from request values if true.
     *
     * @return null
     */
    public function show(bool $from_request = false): void
    {
        // current settings
        if ($from_request) {
            $f_id = $this->request->variable("incubator_from_forum", "");
            $t_id = $this->request->variable("incubator_to_forum", "");
            $days = $this->request->variable("incubator_days", "");
            $freq = $this->request->variable("relocate_ripe_topics_gc", "");
        } else {
            $f_id = $this->config["incubator_from_forum"];
            $t_id = $this->config["incubator_to_forum"];
            $days = $this->config["incubator_days"];
            $freq = $this->config["relocate_ripe_topics_gc"];
        }

        // add a unique security key to the form
        add_form_key($this->form_key_name);

        // make data available to template
        $this->template->assign_vars(
            [
                "U_ACTION" => $this->u_action,
                "F_OPTIONS" => make_forum_select($f_id, false, false, true),
                "T_OPTIONS" => make_forum_select($t_id, false, false, true),
                "DAYS" => $days,
                "FREQ" => $freq,
            ],
        );
    }

    /**
     * Validate user input.
     *
     * @return array
     */
    public function validate(): array
    {
        $errors = [];

        $f_id = $this->request->variable("incubator_from_forum", "");
        $t_id = $this->request->variable("incubator_to_forum", "");
        $days = trim($this->request->variable("incubator_days", ""));
        $freq = trim($this->request->variable("relocate_ripe_topics_gc", ""));

        if (!$f_id) {
            $errors["incubator_from_forum"] = "Required.";
        }

        if (!$t_id) {
            $errors["incubator_to_forum"] = "Required.";
        }

        if (!$days) {
            $errors["incubator_days"] = "Required.";
        }

        if (!$freq) {
            $errors["relocate_ripe_topics_gc"] = "Required.";
        }

        if ($days && (!is_numeric($days) || abs((int) $days) != $days)) {
            $errors["incubator_days"] = "Days must be a whole, positive number.";
        }

        if ($freq && (!is_numeric($freq) || abs((int) $freq) != $freq)) {
            $errors["relocate_ripe_topics_gc"]
                = "Cron frequency must be a whole, positive number.";
        }

        if ($f_id && $t_id && ($f_id == $t_id)) {
            $message = "From and to forums cannot be the same.";
            $errors["incubator_from_forum"] = $message;
            $errors["incubator_to_forum"] = $message;
        }

        return $errors;
    }

    /**
     * Save the submitted data.
     *
     * @return null
     */
    public function save(): void
    {
        // ensure the submitted key is present and valid
        if (!check_form_key($this->form_key_name)) {
            trigger_error("FORM_INVALID");
        }

        $errors = $this->validate();

        if ($errors) {
            $this->template->assign_var("errors", $errors);
            $this->show(true);
            return;
        }

        // save the config values
        $this->set_config("incubator_from_forum");
        $this->set_config("incubator_to_forum");
        $this->set_config("incubator_days", 0);
        $this->set_config("relocate_ripe_topics_gc", 0);

        // display a success message to the user
        // (not an error, not sure why it is called that)
        trigger_error(
            $this->user->lang("ACP_INCUBATOR_SUCCESS")
            . adm_back_link($this->u_action)
        );
    }

    /**
     * Set a config value.
     *
     * @param string $name    The name of the config value to set
     * @param mixed  $default Default value if missing from request
     *
     * @return null
     */
    public function set_config(string $name, $default = ""): void
    {
        $value = $this->request->variable($name, $default);
        $this->config->set($name, $value);
    }
}
