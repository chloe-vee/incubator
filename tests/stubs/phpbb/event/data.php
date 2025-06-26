<?php

namespace phpbb\event;

// class data extends \Symfony\Contracts\EventDispatcher\Event implements \ArrayAccess
class data implements \ArrayAccess
{
	protected $data;

    public function __construct(array $data = array())
    {
		$this->set_data($data);
    }
    public function set_data(array $data = array())
    {
		$this->data = $data;
    }
    public function get_data()
    {
		return $this->data;
    }
    /**
     * Returns data filtered to only include specified keys.
     *
     * This effectively discards any keys added to data by hooks.
     */
    public function get_data_filtered($keys)
    {
    }
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
    {
    }
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
		return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
		$this->data[$offset] = $value;
    }
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
    }
    /**
     * Returns data with updated key in specified offset.
     *
     * @param	string	$subarray	Data array subarray
     * @param	string	$key		Subarray key
     * @param	mixed	$value		Value to update
     */
    public function update_subarray($subarray, $key, $value)
    {
    }
}
