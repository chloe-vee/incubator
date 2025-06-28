<?php

/**
* Header for acp pages
*/
function adm_page_header($page_title)
{
}
/**
* Page footer for acp pages
*/
function adm_page_footer($copyright_html = \true)
{
}
/**
* Generate back link for acp pages
*/
function adm_back_link($u_action)
{
}
/**
 * Build select field options in acp pages
 *
 * @param array				$options_ary Configuration options data
 * @param int|string|bool	$option_default	Configuration option selected value
 *
 * @return array
 */
function build_select(array $options_ary, bool|int|string $option_default = \false) : array
{
}
/**
 * Build radio fields in acp pages
 *
 * @param int|string	$value	Configuration option value
 * @param string		$key	Configuration option key name
 * @param array			$options Configuration options data
 * 							representing array of [values => language_keys]
 *
 * @return array
 */
function phpbb_build_radio(int|string $value, string $key, array $options) : array
{
}
/**
 * Build configuration data arrays or templates for configuration settings
 *
 * @param array			$tpl_type	Configuration setting type data
 * @param string		$key		Configuration option name
 * @param array|object	$new_ary	Updated configuration data
 * @param string		$config_key	Configuration option name
 * @param array			$vars		Configuration setting data
 *
 * @return array|string
 */
function phpbb_build_cfg_template(array $tpl_type, string $key, array|object &$new_ary, string $config_key, array $vars) : array|string
{
}
/**
* Going through a config array and validate values, writing errors to $error. The validation method  accepts parameters separated by ':' for string and int.
* The first parameter defines the type to be used, the second the lower bound and the third the upper bound. Only the type is required.
*/
function validate_config_vars($config_vars, &$cfg_array, &$error)
{
}
/**
* Checks whatever or not a variable is OK for use in the Database
* param mixed $value_ary An array of the form array(array('lang' => ..., 'value' => ..., 'column_type' =>))'
* param mixed $error The error array
*/
function validate_range($value_ary, &$error)
{
}
/**
* Inserts new config display_vars into an exisiting display_vars array
* at the given position.
* Used by extensions.
*
* @param array $display_vars An array of existing config display vars
* @param array $add_config_vars An array of new config display vars
* @param array $where Where to place the new config vars,
*              before or after an exisiting config, as an array
*              of the form: array('after' => 'config_name') or
*              array('before' => 'config_name').
* @return array The array of config display vars
*/
function phpbb_insert_config_array($display_vars, $add_config_vars, $where)
{
}