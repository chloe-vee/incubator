<?php

namespace phpbb\db\migration;

/**
* Abstract base class for database migrations
*
* Each migration consists of a set of schema and data changes to be implemented
* in a subclass. This class provides various utility methods to simplify editing
* a phpBB.
*/
// abstract class migration implements \phpbb\db\migration\migration_interface
abstract class migration
{
    /** @var \phpbb\config\config */
    protected $config;
    /** @var \phpbb\db\driver\driver_interface */
    protected $db;
    /** @var \phpbb\db\tools\tools_interface */
    protected $db_tools;
    /** @var string */
    protected $table_prefix;
    /** @var array Tables array */
    protected $tables;
    /** @var string */
    protected $phpbb_root_path;
    /** @var string */
    protected $php_ext;
    /** @var array Errors, if any occurred */
    protected $errors;
    /** @var array List of queries executed through $this->sql_query() */
    protected $queries = array();
    /**
     * Constructor
     *
     * @param \phpbb\config\config $config
     * @param \phpbb\db\driver\driver_interface $db
     * @param \phpbb\db\tools\tools_interface $db_tools
     * @param string $phpbb_root_path
     * @param string $php_ext
     * @param string $table_prefix
     * @param array $tables
     */
    public function __construct(\phpbb\config\config $config, \phpbb\db\driver\driver_interface $db, \phpbb\db\tools\tools_interface $db_tools, $phpbb_root_path, $php_ext, $table_prefix, $tables)
    {
    }
    /**
     * {@inheritdoc}
     */
    public static function depends_on()
    {
    }
    /**
     * {@inheritdoc}
     */
    public function effectively_installed()
    {
    }
    /**
     * {@inheritdoc}
     */
    public function update_schema()
    {
    }
    /**
     * {@inheritdoc}
     */
    public function revert_schema()
    {
    }
    /**
     * {@inheritdoc}
     */
    public function update_data()
    {
    }
    /**
     * {@inheritdoc}
     */
    public function revert_data()
    {
    }
    /**
     * Wrapper for running queries to generate user feedback on updates
     *
     * @param string $sql SQL query to run on the database
     * @return mixed Query result from db->sql_query()
     */
    protected function sql_query($sql)
    {
    }
    /**
     * Get the list of queries run
     *
     * @return array
     */
    public function get_queries()
    {
    }
}
