<?php

/**
 * Mock for a phpbb_container object.
 *
 * There isn't really a phpbb_container class per say. But for my purposes,
 * the phpbb_container object only needs a get() method, which will in turn
 * return all of the various service objects (template, user, request, ect).
 */

namespace phpbb;

/**
 * Mock container class.
 */
final class container
{
    protected $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function get(string $key)
    {
        return $this->data[$key];
    }
}

