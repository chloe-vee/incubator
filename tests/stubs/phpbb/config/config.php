<?php

namespace phpbb\config;

/**
 * Configuration container class
 *
 * NOTE: A few methods are implemented to make this behave like an array:
 *       .set(), .offsetSet(), .offsetGet()
*/
class config implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /**
     * The configuration data
     * @var array<string,int|string>
     */
    protected $config;
    /**
     * Creates a configuration container with a default set of values
     *
     * @param array<string,int|string> $config The configuration data.
     */
    public function __construct(array $config)
    {
		$this->config = $config;
    }
    /**
     * Retrieves an ArrayIterator over the configuration values.
     *
     * @return \ArrayIterator An iterator over all config data
     */
    public function getIterator() : \ArrayIterator
    {
    }
    /**
     * Checks if the specified config value exists.
     *
     * @param  string $key The configuration option's name.
     * @return bool        Whether the configuration option exists.
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($key)
    {
    }
    /**
     * Retrieves a configuration value.
     *
     * @param  string $key The configuration option's name.
     * @return int|string      The configuration value
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($key)
    {
		return (isset($this->config[$key])) ? $this->config[$key] : '';
    }
    /**
     * Temporarily overwrites the value of a configuration variable.
     *
     * The configuration change will not persist. It will be lost
     * after the request.
     *
     * @param string $offset   The configuration option's name.
     * @param int|string $value The temporary value.
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
		$this->set($offset, $value);
    }
    /**
     * Called when deleting a configuration value directly, triggers an error.
     *
     * @param string $offset The configuration option's name.
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset) : never
    {
    }
    /**
     * Retrieves the number of configuration options currently set.
     *
     * @return int Number of config options
     */
    public function count() : int
    {
    }
    /**
     * Removes a configuration option
     *
     * @param  String $key       The configuration option's name
     * @param  bool   $use_cache Whether this variable should be cached or if it
     *                           changes too frequently to be efficiently cached
     * @return void
     */
    public function delete($key, $use_cache = true)
    {
    }
    /**
     * Sets a configuration option's value
     *
     * @param string $key       The configuration option's name
     * @param int|string $value     New configuration value
     * @param bool   $use_cache Whether this variable should be cached or if it
     *                          changes too frequently to be efficiently cached.
     */
    public function set($key, $value, $use_cache = true)
    {
		$this->config[$key] = $value;
    }
    /**
     * Sets a configuration option's value only if the old_value matches the
     * current configuration value or the configuration value does not exist yet.
     *
     * @param  string $key       The configuration option's name
     * @param  int|string $old_value Current configuration value
     * @param  int|string $new_value New configuration value
     * @param  bool   $use_cache Whether this variable should be cached or if it
     *                           changes too frequently to be efficiently cached.
     * @return bool              True if the value was changed, false otherwise.
     */
    public function set_atomic($key, $old_value, $new_value, $use_cache = true)
    {
    }
    /**
     * Checks configuration option's value only if the new_value matches the
     * current configuration value and the configuration value does exist.Called
     * only after set_atomic has been called.
     *
     * @param  string $key       The configuration option's name
     * @param  int|string $new_value New configuration value
     * @throws \phpbb\exception\http_exception when config value is set and not equal to new_value.
     * @return bool              True if the value was changed, false otherwise.
     */
    public function ensure_lock($key, $new_value)
    {
    }
    /**
     * Increments an integer configuration value.
     *
     * @param string $key       The configuration option's name
     * @param int    $increment Amount to increment by
     * @param bool   $use_cache Whether this variable should be cached or if it
     *                          changes too frequently to be efficiently cached.
     */
    function increment($key, $increment, $use_cache = true)
    {
    }
}
