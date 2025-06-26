<?php

namespace phpbb\controller;

/**
* Controller helper class, contains methods that do things for controllers
*/
class helper
{
    /** @var auth */
    protected $auth;
    /** @var cache_interface */
    protected $cache;
    /** @var config */
    protected $config;
    /** @var manager */
    protected $cron_manager;
    /** @var driver_interface */
    protected $db;
    /** @var dispatcher */
    protected $dispatcher;
    /** @var language */
    protected $language;
    /* @var request_interface */
    protected $request;
    /** @var routing_helper */
    protected $routing_helper;
    /* @var symfony_request */
    protected $symfony_request;
    /** @var template */
    protected $template;
    /** @var user */
    protected $user;
    /** @var string */
    protected $admin_path;
    /** @var string */
    protected $php_ext;
    /** @var bool $sql_explain */
    protected $sql_explain;
    /**
     * Constructor
     *
     * @param auth $auth Auth object
     * @param cache_interface $cache
     * @param config $config Config object
     * @param manager $cron_manager
     * @param driver_interface $db DBAL object
     * @param dispatcher $dispatcher
     * @param language $language
     * @param request_interface $request phpBB request object
     * @param routing_helper $routing_helper Helper to generate the routes
     * @param symfony_request $symfony_request Symfony Request object
     * @param template $template Template object
     * @param user $user User object
     * @param string $root_path phpBB root path
     * @param string $admin_path Admin path
     * @param string $php_ext PHP extension
     * @param bool $sql_explain Flag whether to display sql explain
     */
    public function __construct(\phpbb\auth\auth $auth, \phpbb\cache\driver\driver_interface $cache, \phpbb\config\config $config, \phpbb\cron\manager $cron_manager, \phpbb\db\driver\driver_interface $db, \phpbb\event\dispatcher $dispatcher, \phpbb\language\language $language, \phpbb\request\request_interface $request, \phpbb\routing\helper $routing_helper, \phpbb\symfony_request $symfony_request, \phpbb\template\template $template, \phpbb\user $user, $root_path, $admin_path, $php_ext, $sql_explain = false)
    {
    }
    /**
     * Automate setting up the page and creating the response object.
     *
     * @param string $template_file The template handle to render
     * @param string $page_title The title of the page to output
     * @param int $status_code The status code to be sent to the page header
     * @param bool $display_online_list Do we display online users list
     * @param int $item_id Restrict online users to item id
     * @param string $item Restrict online users to a certain session item, e.g. forum for session_forum_id
     * @param bool $send_headers Whether headers should be sent by page_header(). Defaults to false for controllers.
     *
     * @return Response object containing rendered page
     */
    public function render($template_file, $page_title = '', $status_code = 200, $display_online_list = false, $item_id = 0, $item = 'forum', $send_headers = false)
    {
    }
    /**
     * Generate a URL to a route
	 *
	 * NOTE: The default for $reference_type is:
	 *       \Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_PATH
	 *       Stubbing it as 1 here to avoid unneccessary and annoying dependencies.
     *
     * @param string      $route           Name of the route to travel
     * @param array       $params          String or array of additional url parameters
     * @param bool        $is_amp          Is url using &amp; (true) or & (false)
     * @param string|bool $session_id      Possibility to use a custom session id instead of the global one
     * @param int         $reference_type  The type of reference to be generated (one of the constants)
     * @return string                      The URL already passed through append_sid()
     */
	public function route($route, array $params = array(), $is_amp = true, $session_id = false, $reference_type = 1)
    {
    }
    /**
     * Output an error, effectively the same thing as trigger_error
     *
     * @param string $message The error message
     * @param int $code The error code (e.g. 404, 500, 503, etc.)
     * @return Response A Response instance
     *
     * @deprecated 3.1.3 (To be removed: 4.0.0) Use exceptions instead.
     */
    public function error($message, $code = 500)
    {
    }
    /**
     * Output a message
     *
     * In case of an error, please throw an exception instead
     *
     * @param string $message The message to display (must be a language variable)
     * @param array $parameters The parameters to use with the language var
     * @param string $title Title for the message (must be a language variable)
     * @param int $code The HTTP status code (e.g. 404, 500, 503, etc.)
     * @return Response A Response instance
     */
    public function message($message, array $parameters = array(), $title = 'INFORMATION', $code = 200)
    {
    }
    /**
     * Assigns automatic refresh time meta tag in template
     *
     * @param	int		$time	time in seconds, when redirection should occur
     * @param	string	$url	the URL where the user should be redirected
     * @return	void
     */
    public function assign_meta_refresh_var($time, $url)
    {
    }
    /**
     * Return the current url
     *
     * @return string
     */
    public function get_current_url()
    {
    }
    /**
     * Handle display actions for footer, e.g. SQL report and credit line
     *
     * @param bool $run_cron Flag whether cron should be run
     *
     * @return void
     */
    public function display_footer($run_cron = true)
    {
    }
    /**
     * Display SQL report
     *
     * @return void
     */
    public function display_sql_report()
    {
    }
    /**
     * Set cron task for footer
     *
     * @return void
     */
    protected function set_cron_task()
    {
    }
}
