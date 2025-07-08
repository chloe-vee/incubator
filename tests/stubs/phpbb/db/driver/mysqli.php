<?php

namespace phpbb\db\driver;

/**
* MySQLi Database Abstraction Layer
* mysqli-extension has to be compiled with:
* MySQL 4.1+ or MySQL 5.0+
*/
class mysqli extends \phpbb\db\driver\mysql_base
{
    var $multi_insert = true;
    var $connect_error = '';
    /**
     * {@inheritDoc}
     */
    function sql_connect($sqlserver, $sqluser, $sqlpassword, $database, $port = false, $persistency = false, $new_link = false)
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_server_info($raw = false, $use_cache = true)
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_transaction(string $status = 'begin') : bool
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_query($query = '', $cache_ttl = 0)
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_affectedrows()
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_fetchrow($query_id = false)
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_rowseek($rownum, &$query_id)
    {
    }
    /**
     * {@inheritdoc}
     */
    public function sql_last_inserted_id()
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_freeresult($query_id = false)
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_escape($msg)
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_error() : array
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_close() : bool
    {
    }
    /**
     * {@inheritDoc}
     */
    protected function _sql_report(string $mode, string $query = '') : void
    {
    }
    /**
     * {@inheritDoc}
     */
    function sql_quote($msg)
    {
    }
}