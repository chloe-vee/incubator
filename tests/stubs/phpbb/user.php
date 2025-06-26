<?php

namespace phpbb;

/**
* Base user class
*
* This is the overarching class which contains (through session extend)
* all methods utilised for user functionality during a session.
*/
// class user extends \phpbb\session
class user
{
    /**
     * @var \phpbb\language\language
     */
    protected $language;
    var $style = array();
    var $date_format;
    /**
     * DateTimeZone object holding the timezone of the user
     */
    public $timezone;
    /**
     * @var string Class name of datetime object
     */
    protected $datetime;
    var $lang_name = false;
    var $lang_id = false;
    var $lang_path;
    var $img_lang;
    var $img_array = array();
    /** @var bool */
    protected $is_setup_flag;
    // Able to add new options (up to id 31)
    var $keyoptions = array('viewimg' => 0, 'viewsmilies' => 2, 'viewsigs' => 3, 'viewavatars' => 4, 'viewcensors' => 5, 'attachsig' => 6, 'bbcode' => 8, 'smilies' => 9, 'sig_bbcode' => 15, 'sig_smilies' => 16, 'sig_links' => 17);
    public $profile_fields;
    /**
     * Constructor to set the lang path
     *
     * @param \phpbb\language\language	$lang			phpBB's Language loader
     * @param string						$datetime_class	Class name of datetime class
     */
    public function __construct(\phpbb\language\language $lang, $datetime_class)
    {
    }
    /**
     * Returns whether user::setup was called
     *
     * @return bool
     */
    public function is_setup()
    {
    }
    /**
     * Get expiration time for user tokens, e.g. activation or reset password tokens
     *
     * @return int Expiration for user tokens
     */
    public static function get_token_expiration() : int
    {
    }
    /**
     * Magic getter for BC compatibility
     *
     * Implement array access for user::lang.
     *
     * @param string	$param_name	Name of the BC component the user want to access
     *
     * @return array	The appropriate array
     *
     * @deprecated 3.2.0-dev (To be removed: 4.0.0)
     */
    public function __get($param_name)
    {
    }
    /**
     * Setup basic user-specific items (style, language, ...)
     *
     * @param array|string|false $lang_set Lang set(s) to include, false if none shall be included
     * @param int|false $style_id Style ID to load, false to load default style
     *
     * @return void
     */
    public function setup($lang_set = false, $style_id = false)
    {
    }
    /**
     * More advanced language substitution
     * Function to mimic sprintf() with the possibility of using phpBB's language system to substitute nullar/singular/plural forms.
     * Params are the language key and the parameters to be substituted.
     * This function/functionality is inspired by SHS` and Ashe.
     *
     * Example call: <samp>$user->lang('NUM_POSTS_IN_QUEUE', 1);</samp>
     *
     * If the first parameter is an array, the elements are used as keys and subkeys to get the language entry:
     * Example: <samp>$user->lang(array('datetime', 'AGO'), 1)</samp> uses $user->lang['datetime']['AGO'] as language entry.
     *
     * @deprecated 3.2.0-dev (To be removed 4.0.0)
     */
    function lang()
    {
    }
    /**
     * Determine which plural form we should use.
     * For some languages this is not as simple as for English.
     *
     * @param $number        int|float   The number we want to get the plural case for. Float numbers are floored.
     * @param $force_rule    mixed   False to use the plural rule of the language package
     *                               or an integer to force a certain plural rule
     * @return int|false     The plural-case we need to use for the number plural-rule combination, false if $force_rule
     * 					   was invalid.
     *
     * @deprecated: 3.2.0-dev (To be removed: 4.0.0)
     */
    function get_plural_form($number, $force_rule = false)
    {
    }
    /**
     * Add Language Items - use_db and use_help are assigned where needed (only use them to force inclusion)
     *
     * @param mixed $lang_set specifies the language entries to include
     * @param bool $use_db internal variable for recursion, do not use	@deprecated 3.2.0-dev (To be removed: 4.0.0)
     * @param bool $use_help internal variable for recursion, do not use	@deprecated 3.2.0-dev (To be removed: 4.0.0)
     * @param string $ext_name The extension to load language from, or empty for core files
     *
     * Examples:
     * <code>
     * $lang_set = array('posting', 'help' => 'faq');
     * $lang_set = array('posting', 'viewtopic', 'help' => array('bbcode', 'faq'))
     * $lang_set = array(array('posting', 'viewtopic'), 'help' => array('bbcode', 'faq'))
     * $lang_set = 'posting'
     * $lang_set = array('help' => 'faq', 'db' => array('help:faq', 'posting'))
     * </code>
     *
     * Note: $use_db and $use_help should be removed. The old function was kept for BC purposes,
     * 		so the BC logic is handled here.
     *
     * @deprecated: 3.2.0-dev (To be removed: 4.0.0)
     */
    function add_lang($lang_set, $use_db = false, $use_help = false, $ext_name = '')
    {
    }
    /**
     * Add Language Items from an extension - use_db and use_help are assigned where needed (only use them to force inclusion)
     *
     * @param string $ext_name The extension to load language from, or empty for core files
     * @param mixed $lang_set specifies the language entries to include
     * @param bool $use_db internal variable for recursion, do not use
     * @param bool $use_help internal variable for recursion, do not use
     *
     * Note: $use_db and $use_help should be removed. Kept for BC purposes.
     *
     * @deprecated: 3.2.0-dev (To be removed: 4.0.0)
     */
    function add_lang_ext($ext_name, $lang_set, $use_db = false, $use_help = false)
    {
    }
    /**
     * Format user date
     *
     * @param int $gmepoch unix timestamp
     * @param string|false $format date format in date() notation. | used to indicate relative dates, for example |d m Y|, h:i is translated to Today, h:i.
     * @param bool $forcedate force non-relative date format.
     *
     * @return mixed translated date
     */
    function format_date($gmepoch, $format = false, $forcedate = false)
    {
    }
    /**
     * Create a DateTimeZone object in the context of the current user
     *
     * @param string $user_timezone Time zone of the current user.
     * @return \DateTimeZone DateTimeZone object linked to the current users locale
     */
    public function create_timezone($user_timezone = null)
    {
    }
    /**
     * Create a \phpbb\datetime object in the context of the current user
     *
     * @param string $time String in a format accepted by strtotime().
     * @param ?\DateTimeZone $timezone Time zone of the time.
     * @return \phpbb\datetime Date time object linked to the current users locale
     */
    public function create_datetime(string $time = 'now', \DateTimeZone|null $timezone = null)
    {
    }
    /**
     * Get the UNIX timestamp for a datetime in the users timezone, so we can store it in the database.
     *
     * @param	string			$format		Format of the entered date/time
     * @param	string			$time		Date/time with the timezone applied
     * @param	?\DateTimeZone	$timezone	Timezone of the date/time, falls back to timezone of current user
     * @return	string|false			Returns the unix timestamp or false if date is invalid
     */
    public function get_timestamp_from_format($format, $time, \DateTimeZone|null $timezone = null)
    {
    }
    /**
     * Get language id currently used by the user
     */
    function get_iso_lang_id()
    {
    }
    /**
     * Get users profile fields
     */
    function get_profile_fields($user_id)
    {
    }
    /**
     * Specify/Get image
     */
    function img($img, $alt = '')
    {
    }
    /**
     * Get option bit field from user options.
     *
     * @param string $key option key, as defined in $keyoptions property.
     * @param int|false $data bit field value to use, or false to use $this->data['user_options']
     * @return bool true if the option is set in the bit field, false otherwise
     */
    function optionget(string $key, $data = false)
    {
    }
    /**
     * Set option bit field for user options.
     *
     * @param int $key Option key, as defined in $keyoptions property.
     * @param bool $value True to set the option, false to clear the option.
     * @param int|false $data Current bit field value, or false to use $this->data['user_options']
     * @return int|bool If $data is false, the bit field is modified and
     *                  written back to $this->data['user_options'], and
     *                  return value is true if the bit field changed and
     *                  false otherwise. If $data is not false, the new
     *                  bitfield value is returned.
     */
    function optionset($key, $value, $data = false)
    {
    }
    /**
     * Function to make the user leave the NEWLY_REGISTERED system group.
     * @access public
     */
    function leave_newly_registered()
    {
    }
    /**
     * Returns all password protected forum ids the user is currently NOT authenticated for.
     *
     * @return array     Array of forum ids
     * @access public
     */
    function get_passworded_forums()
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function get_ban_message(array $ban_row, string $ban_triggered_by) : string
    {
    }
}
