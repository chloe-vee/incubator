<?php

namespace phpbb\request;

/**
* All application input is accessed through this class.
*
* It provides a method to disable access to input data through super globals.
* This should force MOD authors to read about data validation.
*/
// class request implements \phpbb\request\request_interface
class request
{
    /**
     * @var	array	The names of super global variables that this class should protect if super globals are disabled.
     */
    // protected $super_globals = array(\phpbb\request\request_interface::POST => '_POST', \phpbb\request\request_interface::GET => '_GET', \phpbb\request\request_interface::REQUEST => '_REQUEST', \phpbb\request\request_interface::COOKIE => '_COOKIE', \phpbb\request\request_interface::SERVER => '_SERVER', \phpbb\request\request_interface::FILES => '_FILES');
    protected $super_globals = array();
    /**
     * @var	array	Stores original contents of $_REQUEST array.
     */
    protected $original_request = null;
    /**
     * @var bool
     */
    protected $super_globals_disabled = false;
    /**
     * @var	array	An associative array that has the value of super global constants as keys and holds their data as values.
     */
    protected $input;
    /**
     * @var	\phpbb\request\type_cast_helper_interface	An instance of a type cast helper providing convenience methods for type conversions.
     */
    protected $type_cast_helper;
    /**
     * Initialises the request class, that means it stores all input data in {@link $input input}
     * and then calls {@link \phpbb\request\deactivated_super_global \phpbb\request\deactivated_super_global}
     */
    // public function __construct(\phpbb\request\type_cast_helper_interface|null $type_cast_helper = null, $disable_super_globals = true)
    public function __construct(\phpbb\request\type_cast_helper_interface $type_cast_helper = null, $disable_super_globals = true)
    {
    }
    /**
     * Getter for $super_globals_disabled
     *
     * @return	bool	Whether super globals are disabled or not.
     */
    public function super_globals_disabled()
    {
    }
    /**
     * Disables access of super globals specified in $super_globals.
     * This is achieved by overwriting the super globals with instances of {@link \phpbb\request\deactivated_super_global \phpbb\request\deactivated_super_global}
     */
    public function disable_super_globals()
    {
    }
    /**
     * Enables access of super globals specified in $super_globals if they were disabled by {@link disable_super_globals disable_super_globals}.
     * This is achieved by making the super globals point to the data stored within this class in {@link $input input}.
     */
    public function enable_super_globals()
    {
    }
    /**
     * This function allows overwriting or setting a value in one of the super global arrays.
     *
     * Changes which are performed on the super globals directly will not have any effect on the results of
     * other methods this class provides. Using this function should be avoided if possible! It will
     * consume twice the the amount of memory of the value
     *
     * @param	string	$var_name		The name of the variable that shall be overwritten
     * @param	mixed	$value			The value which the variable shall contain.
     * 									If this is null the variable will be unset.
     * @param	int		$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     * 									Specifies which super global shall be changed
     */
    public function overwrite($var_name, $value, $super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * Central type safe input handling function.
     * All variables in GET or POST requests should be retrieved through this function to maximise security.
     *
     * @param	string|array	$var_name		The form variable's name from which data shall be retrieved.
     * 											If the value is an array this may be an array of indizes which will give
     * 											direct access to a value at any depth. E.g. if the value of "var" is array(1 => "a")
     * 											then specifying array("var", 1) as the name will return "a".
     * @param	mixed			$default		A default value that is returned if the variable was not set.
     * 											This function will always return a value of the same type as the default.
     * @param	bool			$multibyte		If $default is a string this parameter has to be true if the variable may contain any UTF-8 characters
     *											Default is false, causing all bytes outside the ASCII range (0-127) to be replaced with question marks
     * @param	int				$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     *											Specifies which super global should be used
     *
     * @return	mixed	The value of $_REQUEST[$var_name] run through {@link type_cast_helper_interface::set_var} to ensure that the type is the
     *					the same as that of $default. If the variable is not set $default is returned.
     */
    public function variable($var_name, $default, $multibyte = false, $super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * Get a variable, but without trimming strings.
     * Same functionality as variable(), except does not run trim() on strings.
     * This method should be used when handling passwords.
     *
     * @param	string|array	$var_name		The form variable's name from which data shall be retrieved.
     * 											If the value is an array this may be an array of indizes which will give
     * 											direct access to a value at any depth. E.g. if the value of "var" is array(1 => "a")
     * 											then specifying array("var", 1) as the name will return "a".
     * @param	mixed			$default		A default value that is returned if the variable was not set.
     * 											This function will always return a value of the same type as the default.
     * @param	bool			$multibyte		If $default is a string this parameter has to be true if the variable may contain any UTF-8 characters
     *											Default is false, causing all bytes outside the ASCII range (0-127) to be replaced with question marks
     * @param	int				$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     * 											Specifies which super global should be used
     *
     * @return	mixed	The value of $_REQUEST[$var_name] run through {@link type_cast_helper_interface::set_var} to ensure that the type is the
     *					the same as that of $default. If the variable is not set $default is returned.
     */
    public function untrimmed_variable($var_name, $default, $multibyte = false, $super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function raw_variable($var_name, $default, $super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * Shortcut method to retrieve SERVER variables.
     *
     * Also fall back to getenv(), some CGI setups may need it (probably not, but
     * whatever).
     *
     * @param	string|array	$var_name		See \phpbb\request\request_interface::variable
     * @param	mixed			$default		See \phpbb\request\request_interface::variable
     *
     * @return	mixed	The server variable value.
     */
    public function server($var_name, $default = '')
    {
    }
    /**
     * Shortcut method to retrieve the value of client HTTP headers.
     *
     * @param	string|array	$header_name	The name of the header to retrieve.
     * @param	mixed			$default		See \phpbb\request\request_interface::variable
     *
     * @return	mixed	The header value.
     */
    public function header($header_name, $default = '')
    {
    }
    /**
     * Shortcut method to retrieve $_FILES variables
     *
     * @param string $form_name The name of the file input form element
     *
     * @return array The uploaded file's information or an empty array if the
     * variable does not exist in _FILES.
     */
    public function file($form_name)
    {
    }
    /**
     * Checks whether a certain variable was sent via POST.
     * To make sure that a request was sent using POST you should call this function
     * on at least one variable.
     *
     * @param	string	$name	The name of the form variable which should have a
     *							_p suffix to indicate the check in the code that creates the form too.
     *
     * @return	bool			True if the variable was set in a POST request, false otherwise.
     */
    public function is_set_post($name)
    {
    }
    /**
     * Checks whether a certain variable is set in one of the super global
     * arrays.
     *
     * @param	string	$var			Name of the variable
     * @param	int		$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     *									Specifies the super global which shall be checked
     *
     * @return	bool					True if the variable was sent as input
     */
    public function is_set($var, $super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * Checks whether the current request is an AJAX request (XMLHttpRequest)
     *
     * @return	bool			True if the current request is an ajax request
     */
    public function is_ajax()
    {
    }
    /**
     * Checks if the current request is happening over HTTPS.
     *
     * @return	bool			True if the request is secure.
     */
    public function is_secure()
    {
    }
    /**
     * Returns all variable names for a given super global
     *
     * @param	int		$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     *									The super global from which names shall be taken
     *
     * @return	array	All variable names that are set for the super global.
     *					Pay attention when using these, they are unsanitised!
     */
    public function variable_names($super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * Helper function used by variable() and untrimmed_variable().
     *
     * @param	string|array	$var_name		The form variable's name from which data shall be retrieved.
     * 											If the value is an array this may be an array of indizes which will give
     * 											direct access to a value at any depth. E.g. if the value of "var" is array(1 => "a")
     * 											then specifying array("var", 1) as the name will return "a".
     * @param	mixed			$default		A default value that is returned if the variable was not set.
     * 											This function will always return a value of the same type as the default.
     * @param	bool			$multibyte		If $default is a string this parameter has to be true if the variable may contain any UTF-8 characters
     *											Default is false, causing all bytes outside the ASCII range (0-127) to be replaced with question marks
     * @param	int				$super_global	(\phpbb\request\request_interface::POST|GET|REQUEST|COOKIE)
     * 											Specifies which super global should be used
     * @param	bool			$trim			Indicates whether trim() should be applied to string values.
     *
     * @return	mixed	The value of $_REQUEST[$var_name] run through {@link type_cast_helper_interface::set_var} to ensure that the type is the
     *					the same as that of $default. If the variable is not set $default is returned.
     */
    protected function _variable($var_name, $default, $multibyte = false, $super_global = \phpbb\request\request_interface::REQUEST, $trim = true)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function get_super_global($super_global = \phpbb\request\request_interface::REQUEST)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function escape($value, $multibyte)
    {
    }
}
