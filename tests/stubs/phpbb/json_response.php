<?php

namespace phpbb;

/**
* JSON class
*/
class json_response
{
    public $data;
    public $exit;

    /**
     * Send the data to the client and exit the script.
     *
     * @param array $data Any additional data to send.
     * @param bool $exit Will exit the script if true.
     */
    public function send($data, $exit = true)
    {
        $this->data = $data;
        $this->exit = $exit;
    }
}
