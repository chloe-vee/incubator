<?php

namespace phpbb\language;

/**
 * Wrapper class for loading translations
 */
class language
{
    /**
     * Global fallback language
     *
     * ISO code of the language to fallback to when the specified language entries
     * cannot be found.
     *
     * @var string
     */
    const FALLBACK_LANGUAGE = 'en';
    /**
     * @var array	List of common language files
     */
    protected $common_language_files;
    /**
     * @var bool
     */
    protected $common_language_files_loaded;
    /**
     * @var string|null	ISO code of the default board language
     */
    protected $default_language;
    /**
     * @var string|null	ISO code of the User's language
     */
    protected $user_language;
    /**
     * @var array	Language fallback array (the order is important)
     */
    protected $language_fallback;
    /**
     * @var array	Array of language variables
     */
    protected $lang;
    /**
     * @var array	Loaded language sets
     */
    protected $loaded_language_sets;
    /**
     * @var \phpbb\language\language_file_loader Language file loader
     */
    protected $loader;
    /**
     * Constructor
     *
     * @param \phpbb\language\language_file_loader	$loader			Language file loader
     * @param array|null							$common_modules	Array of common language modules to load (optional)
     */
    public function __construct(\phpbb\language\language_file_loader $loader, $common_modules = null)
    {
    }
    /**
     * Function to set user's language to display.
     *
     * @param string	$user_lang_iso		ISO code of the User's language
     * @param bool		$reload				Whether or not to reload language files
     */
    public function set_user_language(string $user_lang_iso, $reload = false)
    {
    }
    /**
     * Function to set the board's default language to display.
     *
     * @param string	$default_lang_iso	ISO code of the board's default language
     * @param bool		$reload				Whether or not to reload language files
     */
    public function set_default_language(string $default_lang_iso, $reload = false)
    {
    }
    /**
     * Returns language array
     *
     * Note: This function is needed for the BC purposes, until \phpbb\user::lang[] is
     *       not removed.
     *
     * @return array	Array of loaded language strings
     */
    public function get_lang_array()
    {
    }
    /**
     * Add Language Items
     *
     * Examples:
     * <code>
     * $component = array('posting');
     * $component = array('posting', 'viewtopic')
     * $component = 'posting'
     * </code>
     *
     * @param string|array	$component		The name of the language component to load
     * @param string|null	$extension_name	Name of the extension to load component from, or null for core file
     */
    public function add_lang($component, $extension_name = null)
    {
    }
    /**
     * @param	array|string	$key	The language key we want to know more about. Can be string or array.
     *
     * @return bool		Returns whether the language key is set.
     */
    public function is_set($key)
    {
    }
    /**
     * Advanced language substitution
     *
     * Function to mimic sprintf() with the possibility of using phpBB's language system to substitute nullar/singular/plural forms.
     * Params are the language key and the parameters to be substituted.
     * This function/functionality is inspired by SHS` and Ashe.
     *
     * Example call: <samp>$language->lang('NUM_POSTS_IN_QUEUE', 1);</samp>
     *
     * If the first parameter is an array, the elements are used as keys and subkeys to get the language entry:
     * Example: <samp>$language->lang(array('datetime', 'AGO'), 1)</samp> uses $language->lang['datetime']['AGO'] as language entry.
     *
     * @return string	Return localized string or the language key if the translation is not available
     */
    public function lang()
    {
    }
    /**
     * Returns the raw value associated to a language key or the language key no translation is available.
     * No parameter substitution is performed, can be a string or an array.
     *
     * @param string|array	$key	Language key
     *
     * @return array|string
     */
    public function lang_raw($key)
    {
    }
    /**
     * Act like lang() but takes a key and an array of parameters instead of using variadic
     *
     * @param string|array	$key	Language key
     * @param array			$args	Parameters
     *
     * @return string
     */
    public function lang_array($key, array $args = [])
    {
    }
    /**
     * Loads common language files
     */
    protected function load_common_language_files()
    {
    }
    /**
     * Inject default values based on composer.json
     *
     * @return void
     */
    protected function inject_default_variables() : void
    {
    }
    /**
     * Determine which plural form we should use.
     *
     * For some languages this is not as simple as for English.
     *
     * @param int|float		$number		The number we want to get the plural case for. Float numbers are floored.
     * @param int|bool		$force_rule	False to use the plural rule of the language package
     *									or an integer to force a certain plural rule
     *
     * @return int	The plural-case we need to use for the number plural-rule combination
     *
     * @throws invalid_plural_rule_exception	When $force_rule has an invalid value
     */
    public function get_plural_form($number, $force_rule = false)
    {
    }
    /**
     * Returns the ISO code of the used language
     *
     * @return string	The ISO code of the currently used language
     */
    public function get_used_language()
    {
    }
    /**
     * Returns language fallback data
     *
     * @param bool	$reload	Whether or not to reload language files
     */
    protected function set_fallback_array($reload = false)
    {
    }
    /**
     * Load core language file
     *
     * @param string	$component	Name of the component to load
     */
    protected function load_core_file($component)
    {
    }
    /**
     * Load extension language file
     *
     * @param string	$extension_name	Name of the extension to load language from
     * @param string	$component		Name of the component to load
     */
    protected function load_extension($extension_name, $component)
    {
    }
    /**
     * Reload language files
     */
    protected function reload_language_files()
    {
    }
}