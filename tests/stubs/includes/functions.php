<?php

// Common global functions
/**
* Generates an alphanumeric random string of given length
*
* @param int $num_chars Length of random string, defaults to 8.
* This number should be less or equal than 64.
*
* @return string
*/
function gen_rand_string($num_chars = 8)
{
}
/**
* Generates a user-friendly alphanumeric random string of given length
* We remove 0 and O so users cannot confuse those in passwords etc.
*
* @param int $num_chars Length of random string, defaults to 8.
* This number should be less or equal than 64.
*
* @return string
*/
function gen_rand_string_friendly($num_chars = 8)
{
}
/**
* Return unique id
*/
function unique_id()
{
}
/**
* Wrapper for mt_rand() which allows swapping $min and $max parameters.
*
* PHP does not allow us to swap the order of the arguments for mt_rand() anymore.
* (since PHP 5.3.4, see http://bugs.php.net/46587)
*
* @param int $min		Lowest value to be returned
* @param int $max		Highest value to be returned
*
* @return int			Random integer between $min and $max (or $max and $min)
*/
function phpbb_mt_rand($min, $max)
{
}
/**
* Wrapper for getdate() which returns the equivalent array for UTC timestamps.
*
* @param int $time		Unix timestamp (optional)
*
* @return array			Returns an associative array of information related to the timestamp.
*						See http://www.php.net/manual/en/function.getdate.php
*/
function phpbb_gmgetdate($time = \false)
{
}
/**
* Return formatted string for filesizes
*
* @param mixed		$value			filesize in bytes
*								(non-negative number; int, float or string)
* @param bool		$string_only	true if language string should be returned
* @param array|null $allowed_units	only allow these units (data array indexes)
*
* @return array|string                    data array if $string_only is false
*/
// function get_formatted_filesize($value, bool $string_only = \true, array|null $allowed_units = \null)
function get_formatted_filesize($value, bool $string_only = \true, array $allowed_units = \null)
{
}
/**
* Determine whether we are approaching the maximum execution time. Should be called once
* at the beginning of the script in which it's used.
* @return	bool	Either true if the maximum execution time is nearly reached, or false
*					if some time is still left.
*/
function still_on_time($extra_time = 15)
{
}
/**
* Wrapper for version_compare() that allows using uppercase A and B
* for alpha and beta releases.
*
* See http://www.php.net/manual/en/function.version-compare.php
*
* @param string			$version1		First version number
* @param string			$version2		Second version number
* @param string|null	$operator		Comparison operator (optional)
*
* @return mixed				Boolean (true, false) if comparison operator is specified.
*							Integer (-1, 0, 1) otherwise.
*/
// function phpbb_version_compare(string $version1, string $version2, string|null $operator = \null)
function phpbb_version_compare(string $version1, string $version2, string $operator = \null)
{
}
// functions used for building option fields
/**
 * Pick a language, any language ...
 *
 * @param \phpbb\db\driver\driver_interface $db DBAL driver
 * @param string $default	Language ISO code to be selected by default in the dropdown list
 * @param array $langdata	Language data in format of array(array('lang_iso' => string, lang_local_name => string), ...)
 */
function phpbb_language_select(\phpbb\db\driver\driver_interface $db, string $default = '', array $langdata = []) : array
{
}
/**
 * Pick a template/theme combo
 *
 * @param string $default	Style ID to be selected by default in the dropdown list
 * @param bool $all			Flag indicating if all styles data including inactive ones should be fetched
 * @param array $styledata	Style data in format of array(array('style_id' => int, style_name => string), ...)
 *
 * @return string			HTML options for style selection dropdown list.
 */
function style_select($default = '', $all = \false, array $styledata = [])
{
}
/**
* Format the timezone offset with hours and minutes
*
* @param	int		$tz_offset	Timezone offset in seconds
* @param	bool	$show_null	Whether null offsets should be shown
* @return	string		Normalized offset string:	-7200 => -02:00
*													16200 => +04:30
*/
function phpbb_format_timezone_offset($tz_offset, $show_null = \false)
{
}
/**
* Compares two time zone labels.
* Arranges them in increasing order by timezone offset.
* Places UTC before other timezones in the same offset.
*/
function phpbb_tz_select_compare($a, $b)
{
}
/**
* Return list of timezone identifiers
* We also add the selected timezone if we can create an object with it.
* DateTimeZone::listIdentifiers seems to not add all identifiers to the list,
* because some are only kept for backward compatible reasons. If the user has
* a deprecated value, we add it here, so it can still be kept. Once the user
* changed his value, there is no way back to deprecated values.
*
* @param	string		$selected_timezone		Additional timezone that shall
*												be added to the list of identiers
* @return		array		DateTimeZone::listIdentifiers and additional
*							selected_timezone if it is a valid timezone.
*/
function phpbb_get_timezone_identifiers($selected_timezone)
{
}
/**
* Options to pick a timezone and date/time
*
* @param	\phpbb\user	$user				Object of the current user
* @param	string		$default			A timezone to select
* @param	boolean		$truncate			Shall we truncate the options text
*
* @return	string		Returns an array containing the options for the time selector.
*/
function phpbb_timezone_select($user, $default = '', $truncate = \false)
{
}
// Functions handling topic/post tracking/marking
/**
* Marks a topic/forum as read
* Marks a topic as posted to
*
* @param string $mode (all, topics, topic, post)
* @param int|bool $forum_id Used in all, topics, and topic mode
* @param int|bool $topic_id Used in topic and post mode
* @param int $post_time 0 means current time(), otherwise to set a specific mark time
* @param int $user_id can only be used with $mode == 'post'
*/
function markread($mode, $forum_id = \false, $topic_id = \false, $post_time = 0, $user_id = 0)
{
}
/**
* Get topic tracking info by using already fetched info
*/
function get_topic_tracking($forum_id, $topic_ids, &$rowset, $forum_mark_time)
{
}
/**
* Get topic tracking info from db (for cookie based tracking only this function is used)
*/
function get_complete_topic_tracking($forum_id, $topic_ids)
{
}
/**
* Get list of unread topics
*
* @param int $user_id			User ID (or false for current user)
* @param string $sql_extra		Extra WHERE SQL statement
* @param string $sql_sort		ORDER BY SQL sorting statement
* @param string $sql_limit		Limits the size of unread topics list, 0 for unlimited query
* @param string $sql_limit_offset  Sets the offset of the first row to search, 0 to search from the start
*
* @return int[]		Topic ids as keys, mark_time of topic as value
*/
function get_unread_topics($user_id = \false, $sql_extra = '', $sql_sort = '', $sql_limit = 1001, $sql_limit_offset = 0)
{
}
/**
* Check for read forums and update topic tracking info accordingly
*
* @param int $forum_id the forum id to check
* @param int $forum_last_post_time the forums last post time
* @param int $f_mark_time the forums last mark time if user is registered and load_db_lastread enabled
* @param int $mark_time_forum false if the mark time needs to be obtained, else the last users forum mark time
*
* @return true if complete forum got marked read, else false.
*/
function update_forum_tracking_info($forum_id, $forum_last_post_time, $f_mark_time = \false, $mark_time_forum = \false)
{
}
/**
* Transform an array into a serialized format
*/
function tracking_serialize($input)
{
}
/**
* Transform a serialized array into an actual array
*/
function tracking_unserialize($string, $max_depth = 3)
{
}
// Server functions (building urls, redirecting...)
/**
* Append session id to url.
*
* @param string $url The url the session id needs to be appended to (can have params)
* @param mixed $params String or array of additional url parameters
* @param bool $is_amp Is url using &amp; (true) or & (false)
* @param string $session_id Possibility to use a custom session id instead of the global one; deprecated as of 4.0.0-a1
* @param bool $is_route Is url generated by a route.
*
* @return string The corrected url.
*
* Examples:
* <code> append_sid("{$phpbb_root_path}viewtopic.$phpEx?t=1");
* append_sid("{$phpbb_root_path}viewtopic.$phpEx", 't=1');
* append_sid("{$phpbb_root_path}viewtopic.$phpEx", 't=1', false);
* append_sid("{$phpbb_root_path}viewtopic.$phpEx", array('t' => 1, 'f' => 2));
* </code>
*
*/
function append_sid($url, $params = \false, $is_amp = \true, $session_id = \false, $is_route = \false)
{
}
/**
* Generate board url (example: http://www.example.com/phpBB)
*
* @param bool $without_script_path if set to true the script path gets not appended (example: http://www.example.com)
*
* @return string the generated board url
*/
function generate_board_url($without_script_path = \false)
{
}
/**
* Redirects the user to another page then exits the script nicely
* This function is intended for urls within the board. It's not meant to redirect to cross-domains.
*
* @param string $url The url to redirect to
* @param bool $return If true, do not redirect but return the sanitized URL. Default is no return.
* @param bool $disable_cd_check If true, redirect() will redirect to an external domain. If false, the redirect point to the boards url if it does not match the current domain. Default is false.
* @return string|never
*/
function redirect($url, $return = \false, $disable_cd_check = \false)
{
}
/**
 * Returns the install redirect path for phpBB.
 *
 * @param string $phpbb_root_path The root path of the phpBB installation.
 * @param string $phpEx The file extension of php files, e.g., "php".
 * @return string The install redirect path.
 */
function phpbb_get_install_redirect(string $phpbb_root_path, string $phpEx) : string
{
}
/**
* Re-Apply session id after page reloads
*/
function reapply_sid($url, $is_route = \false)
{
}
/**
* Returns url from the session/current page with an re-appended SID with optionally stripping vars from the url
*/
function build_url($strip_vars = \false)
{
}
/**
* Meta refresh assignment
* Adds META template variable with meta http tag.
*
* @param int $time Time in seconds for meta refresh tag
* @param string $url URL to redirect to. The url will go through redirect() first before the template variable is assigned
* @param bool $disable_cd_check If true, meta_refresh() will redirect to an external domain. If false, the redirect point to the boards url if it does not match the current domain. Default is false.
*/
function meta_refresh($time, $url, $disable_cd_check = \false)
{
}
/**
* Outputs correct status line header.
*
* Depending on php sapi one of the two following forms is used:
*
* Status: 404 Not Found
*
* HTTP/1.x 404 Not Found
*
* HTTP version is taken from HTTP_VERSION environment variable,
* and defaults to 1.0.
*
* Sample usage:
*
* send_status_line(404, 'Not Found');
*
* @param int $code HTTP status code
* @param string $message Message for the status code
* @return void
*/
function send_status_line($code, $message)
{
}
/**
* Returns the HTTP version used in the current request.
*
* Handles the case of being called before $request is present,
* in which case it falls back to the $_SERVER superglobal.
*
* @return string HTTP version
*/
function phpbb_request_http_version()
{
}
//Form validation
/**
* Add a secret hash   for use in links/GET requests
* @param string  $link_name The name of the link; has to match the name used in check_link_hash, otherwise no restrictions apply
* @return string the hash
*/
function generate_link_hash($link_name)
{
}
/**
* checks a link hash - for GET requests
* @param string $token the submitted token
* @param string $link_name The name of the link
* @return boolean true if all is fine
*/
function check_link_hash($token, $link_name)
{
}
/**
* Add a secret token to the form (requires the S_FORM_TOKEN template variable)
* @param string  $form_name The name of the form; has to match the name used in check_form_key, otherwise no restrictions apply
* @param string  $template_variable_suffix A string that is appended to the name of the template variable to which the form elements are assigned
*/
function add_form_key($form_name, $template_variable_suffix = '')
{
}
/**
 * Check the form key. Required for all altering actions not secured by confirm_box
 *
 * @param	string	$form_name	The name of the form; has to match the name used
 *								in add_form_key, otherwise no restrictions apply
 * @param	int		$timespan	The maximum acceptable age for a submitted form
 *								in seconds. Defaults to the config setting.
 * @return	bool	True, if the form key was valid, false otherwise
 */
function check_form_key($form_name, $timespan = \false)
{
    return true;
}
// Message/Login boxes
/**
* Build Confirm box
* @param boolean $check True for checking if confirmed (without any additional parameters) and false for displaying the confirm box
* @param string|array $title Title/Message used for confirm box.
*		message text is _CONFIRM appended to title.
*		If title cannot be found in user->lang a default one is displayed
*		If title_CONFIRM cannot be found in user->lang the text given is used.
*       If title is an array, the first array value is used as explained per above,
*       all other array values are sent as parameters to the language function.
* @param string $hidden Hidden variables
* @param string $html_body Template used for confirm box
* @param string $u_action Custom form action
*
* @return bool True if confirmation was successful, false if not
*/
function confirm_box($check, $title = '', $hidden = '', $html_body = 'confirm_body.html', $u_action = '')
{
}
/**
* Generate login box or verify password
*/
function login_box($redirect = '', $l_explain = '', $l_success = '', $admin = \false, $s_display = \true)
{
}
/**
* Generate forum login box
*/
function login_forum_box($forum_data)
{
}
// Little helpers
/**
* Little helper for the build_hidden_fields function
*/
function _build_hidden_fields($key, $value, $specialchar, $stripslashes)
{
}
/**
* Build simple hidden fields from array
*
* @param array $field_ary an array of values to build the hidden field from
* @param bool $specialchar if true, keys and values get specialchared
* @param bool $stripslashes if true, keys and values get stripslashed
*
* @return string the hidden fields
*/
function build_hidden_fields($field_ary, $specialchar = \false, $stripslashes = \false)
{
}
/**
* Return a nicely formatted backtrace.
*
* Turns the array returned by debug_backtrace() into HTML markup.
* Also filters out absolute paths to phpBB root.
*
* @return string	HTML markup
*/
function get_backtrace()
{
}
/**
* This function returns a regular expression pattern for commonly used expressions
* Use with / as delimiter for email mode and # for url modes
* mode can be: email|bbcode_htm|url|url_inline|www_url|www_url_inline|relative_url|relative_url_inline|ipv4|ipv6
*/
function get_preg_expression($mode)
{
}
/**
* Generate regexp for naughty words censoring
* Depends on whether installed PHP version supports unicode properties
*
* @param string	$word			word template to be replaced
*
* @return string $preg_expr		regex to use with word censor
*/
function get_censor_preg_expression($word)
{
}
/**
* Returns the first block of the specified IPv6 address and as many additional
* ones as specified in the length parameter.
* If length is zero, then an empty string is returned.
* If length is greater than 3 the complete IP will be returned
*/
function short_ipv6($ip, $length)
{
}
/**
* Normalises an internet protocol address,
* also checks whether the specified address is valid.
*
* IPv4 addresses are returned 'as is'.
*
* IPv6 addresses are normalised according to
*	A Recommendation for IPv6 Address Text Representation
*	http://tools.ietf.org/html/draft-ietf-6man-text-addr-representation-07
*
* @param string $address	IP address
*
* @return string|false	false if specified address is not valid,
*						string otherwise
*/
function phpbb_ip_normalise(string $address)
{
}
// Handler, header and footer
/**
* Error and message handler, call with trigger_error if read
* @return bool true to bypass internal error handler, false otherwise
*/
function msg_handler($errno, $msg_text, $errfile, $errline) : bool
{
}
/**
* Removes absolute path to phpBB root directory from error messages
* and converts backslashes to forward slashes.
*
* @param string $errfile	Absolute file path
*							(e.g. /var/www/phpbb/phpBB/includes/functions.php)
*							Please note that if $errfile is outside of the phpBB root,
*							the root path will not be found and can not be filtered.
* @return string			Relative file path
*							(e.g. /includes/functions.php)
*/
function phpbb_filter_root_path($errfile)
{
}
/**
* Queries the session table to get information about online guests
* @param int $item_id Limits the search to the item with this id
* @param string $item The name of the item which is stored in the session table as session_{$item}_id
* @return int The number of active distinct guest sessions
*/
function obtain_guest_count($item_id = 0, $item = 'forum')
{
}
/**
* Queries the session table to get information about online users
* @param int $item_id Limits the search to the item with this id
* @param string $item The name of the item which is stored in the session table as session_{$item}_id
* @return array An array containing the ids of online, hidden and visible users, as well as statistical info
*/
function obtain_users_online($item_id = 0, $item = 'forum')
{
}
/**
* Uses the result of obtain_users_online to generate a localized, readable representation.
* @param mixed $online_users result of obtain_users_online - array with user_id lists for total, hidden and visible users, and statistics
* @param int $item_id Indicate that the data is limited to one item and not global
* @param string $item The name of the item which is stored in the session table as session_{$item}_id
* @return array An array containing the string for output to the template
*/
function obtain_users_online_string($online_users, $item_id = 0, $item = 'forum')
{
}
/**
* Get option bitfield from custom data
*
* @param int	$bit		The bit/value to get
* @param int	$data		Current bitfield to check
* @return bool	Returns true if value of constant is set in bitfield, else false
*/
function phpbb_optionget($bit, $data)
{
}
/**
* Set option bitfield
*
* @param int	$bit		The bit/value to set/unset
* @param bool	$set		True if option should be set, false if option should be unset.
* @param int	$data		Current bitfield to change
*
* @return int	The new bitfield
*/
function phpbb_optionset($bit, $set, $data)
{
}
/**
* Escapes and quotes a string for use as an HTML/XML attribute value.
*
* This is a port of Python xml.sax.saxutils quoteattr.
*
* The function will attempt to choose a quote character in such a way as to
* avoid escaping quotes in the string. If this is not possible the string will
* be wrapped in double quotes and double quotes will be escaped.
*
* @param string $data The string to be escaped
* @param array $entities Associative array of additional entities to be escaped
* @return string Escaped and quoted string
*/
function phpbb_quoteattr($data, $entities = \null)
{
}
/**
* Generate page header
*/
function page_header($page_title = '', $display_online_list = \false, $item_id = 0, $item = 'forum', $send_headers = \true)
{
}
/**
* Generate the debug output string
*
* @param \phpbb\db\driver\driver_interface	$db			Database connection
* @param \phpbb\config\config				$config		Config object
* @param \phpbb\auth\auth					$auth		Auth object
* @param \phpbb\user						$user		User object
* @param \phpbb\event\dispatcher_interface	$phpbb_dispatcher	Event dispatcher
* @return string
*/
function phpbb_generate_debug_output(\phpbb\db\driver\driver_interface $db, \phpbb\config\config $config, \phpbb\auth\auth $auth, \phpbb\user $user, \phpbb\event\dispatcher_interface $phpbb_dispatcher)
{
}
/**
* Generate page footer
*
* @param bool $run_cron Whether or not to run the cron
* @param bool $display_template Whether or not to display the template
* @param bool $exit_handler Whether or not to run the exit_handler()
*/
function page_footer($run_cron = \true, $display_template = \true, $exit_handler = \true)
{
}
/**
* Closing the cache object and the database
* Cool function name, eh? We might want to add operations to it later
*/
function garbage_collection()
{
}
/**
* Handler for exit calls in phpBB.
*
* Note: This function is called after the template has been outputted.
 *
 * @return void
*/
function exit_handler()
{
}
/**
* Get the board contact details (e.g. for emails)
*
* @param \phpbb\config\config	$config
* @param string					$phpEx
* @return string
*/
function phpbb_get_board_contact(\phpbb\config\config $config, $phpEx)
{
}
/**
* Get a clickable board contact details link
*
* @param \phpbb\config\config	$config
* @param string					$phpbb_root_path
* @param string					$phpEx
* @return string
*/
function phpbb_get_board_contact_link(\phpbb\config\config $config, $phpbb_root_path, $phpEx)
{
}
