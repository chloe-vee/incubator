<?php

namespace phpbb\db\driver;

/**
* Abstract MySQL Database Base Abstraction Layer
*/
abstract class mysql_base extends \phpbb\db\driver\driver
{
    /**
     * {@inheritDoc}
     */
    public function sql_concatenate($expr1, $expr2)
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_query_limit(string $query, int $total, int $offset = 0, int $cache_ttl = 0)
    {
    }
    /**
     * {@inheritDoc}
     */
    function get_estimated_row_count($table_name)
    {
    }
    /**
     * {@inheritDoc}
     */
    function get_row_count($table_name)
    {
    }
    /**
     * Gets some information about the specified table.
     *
     * @param string $table_name		Table name
     *
     * @return array
     *
     * @access protected
     */
    function get_table_status($table_name)
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_custom_build(string $stage, $data)
    {
    }
}