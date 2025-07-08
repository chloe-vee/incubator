<?php
/**
*
* This file is part of the phpBB Forum Software package.
*
* @copyright (c) phpBB Limited <https://www.phpbb.com>
* @license GNU General Public License, version 2 (GPL-2.0)
*
* For full copyright and license information, please see
* the docs/CREDITS.txt file.
*
*/

namespace phpbb\db\driver;

/**
* Database Abstraction Layer
*/
abstract class driver implements driver_interface
{
    var $db_connect_id;
    var $query_result;
    var $return_on_error = false;
    var $transaction = false;
    var $sql_time = 0;
    var $num_queries = array();
    var $open_queries = array();

    var $curtime = 0;
    var $query_hold = '';
    var $html_hold = '';
    var $sql_report = '';

    /** @var string Last query text */
    protected $last_query_text = '';

    var $persistency = false;
    var $user = '';
    var $server = '';
    var $dbname = '';

    // Set to true if error triggered
    var $sql_error_triggered = false;

    // Holding the last sql query on sql error
    var $sql_error_sql = '';
    // Holding the error information - only populated if sql_error_triggered is set
    var $sql_error_returned = array();

    // Holding transaction count
    var $transactions = 0;

    // Supports multi inserts?
    var $multi_insert = false;

    /**
    * Current sql layer
    */
    var $sql_layer = '';

    /**
    * Wildcards for matching any (%) or exactly one (_) character within LIKE expressions
    */
    var $any_char;
    var $one_char;

    /**
    * Exact version of the DBAL, directly queried
    */
    var $sql_server_version = false;

    const LOGICAL_OP = 0;
    const STATEMENTS = 1;
    const LEFT_STMT = 0;
    const COMPARE_OP = 1;
    const RIGHT_STMT = 2;
    const SUBQUERY_OP = 3;
    const SUBQUERY_SELECT_TYPE = 4;
    const SUBQUERY_BUILD = 5;

    /**
    * @var bool
    */
    protected $debug_load_time = false;

    /**
    * @var bool
    */
    protected $debug_sql_explain = false;

    /**
    * Constructor
    */
    function __construct()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function set_debug_load_time($value)
    {
    }

    /**
    * {@inheritdoc}
    */
    public function set_debug_sql_explain($value)
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_sql_layer()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_db_name()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_any_char()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_one_char()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_db_connect_id()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_sql_error_triggered()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_sql_error_sql()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_transaction()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_sql_time()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_sql_error_returned()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function get_multi_insert()
    {
    }

    /**
    * {@inheritdoc}
    */
    public function set_multi_insert($multi_insert)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_return_on_error($fail = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_num_queries($cached = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_add_num_queries($cached = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_close()
    {
    }

    /**
     * Close sql connection
     *
     * @return    bool        False if failure
     */
    abstract protected function _sql_close(): bool;

    /**
    * {@inheritDoc}
    */
    function sql_query_limit($query, $total, $offset = 0, $cache_ttl = 0)
    {
    }

    /**
     * Build LIMIT query
     *
     * @param    string    $query        The SQL query to execute
     * @param    int        $total        The number of rows to select
     * @param    int        $offset
     * @param    int        $cache_ttl    Either 0 to avoid caching or
     *                the time in seconds which the result shall be kept in cache
     * @return    mixed    Buffered, seekable result handle, false on error
     */
    abstract protected function _sql_query_limit(string $query, int $total, int $offset = 0, int $cache_ttl = 0);

    /**
    * {@inheritDoc}
    */
    function sql_fetchrowset($query_id = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_rowseek($rownum, &$query_id)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_fetchfield($field, $rownum = false, &$query_id = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_like_expression($expression)
    {
    }

    /**
     * Build LIKE expression
     *
     * @param string $expression Base expression
     *
     * @return string LIKE expression
     */
    protected function _sql_like_expression(string $expression): string
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_not_like_expression($expression)
    {
    }

    /**
     * Build NOT LIKE expression
     *
     * @param string $expression Base expression
     *
     * @return string NOT LIKE expression
     */
    protected function _sql_not_like_expression(string $expression): string
    {
    }

    /**
    * {@inheritDoc}
    */
    public function sql_case($condition, $action_true, $action_false = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    public function sql_concatenate($expr1, $expr2)
    {
    }

    function sql_buffer_nested_transactions()
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_transaction($status = 'begin')
    {
    }

    /**
     * SQL Transaction
     *
     * @param string $status        Should be one of the following strings:
     *                                begin, commit, rollback
     *
     * @return    bool    Success/failure of the transaction query
     */
    abstract protected function _sql_transaction(string $status = 'begin'): bool;

    /**
    * {@inheritDoc}
    */
    function sql_build_array($query, $assoc_ary = [])
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_in_set($field, $array, $negate = false, $allow_empty_set = false)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_bit_and($column_name, $bit, $compare = '')
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_bit_or($column_name, $bit, $compare = '')
    {
    }

    /**
    * {@inheritDoc}
    */
    function cast_expr_to_bigint($expression)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function sql_nextid()
    {
    }

    function cast_expr_to_string($expression)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_lower_text($column_name)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_multi_insert($table, $sql_ary)
    {
    }

    /**
    * Function for validating values
    * @access private
    */
    function _sql_validate_value($var)
    {
    }

    /**
    * {@inheritDoc}
    */
    function sql_build_query($query, $array)
    {
    }

    /**
     * Build db-specific query data
     *
     * @param string $stage Query stage, can be 'FROM' or 'WHERE'
     * @param string|array $data A string containing the CROSS JOIN query or an array of WHERE clauses
     *
     * @return string|array The db-specific query fragment
     */
    protected function _sql_custom_build(string $stage, $data)
    {
        return $data;
    }

    protected function _process_boolean_tree_first($operations_ary)
    {
        // In cases where an array exists but there is no head condition,
        // it should be because there's only 1 WHERE clause. This seems the best way to deal with it.
        if ($operations_ary[self::LOGICAL_OP] !== 'AND' &&
            $operations_ary[self::LOGICAL_OP] !== 'OR')
        {
            $operations_ary = array('AND', array($operations_ary));
        }
        return $this->_process_boolean_tree($operations_ary) . "\n";
    }

    protected function _process_boolean_tree($operations_ary)
    {
        $operation = $operations_ary[self::LOGICAL_OP];

        foreach ($operations_ary[self::STATEMENTS] as &$condition)
        {
            switch ($condition[self::LOGICAL_OP])
            {
                case 'AND':
                case 'OR':

                    $condition = ' ( ' . $this->_process_boolean_tree($condition) . ') ';

                break;
                case 'NOT':

                    $condition = ' NOT (' . $this->_process_boolean_tree($condition) . ') ';

                break;

                default:

                    switch (count($condition))
                    {
                        case 3:

                            // Typical 3 element clause with {left hand} {operator} {right hand}
                            switch ($condition[self::COMPARE_OP])
                            {
                                case 'IN':
                                case 'NOT_IN':

                                    // As this is used with an IN, assume it is a set of elements for sql_in_set()
                                    $condition = $this->sql_in_set($condition[self::LEFT_STMT], $condition[self::RIGHT_STMT], $condition[self::COMPARE_OP] === 'NOT_IN', true);

                                break;

                                case 'LIKE':

                                    $condition = $condition[self::LEFT_STMT] . ' ' . $this->sql_like_expression($condition[self::RIGHT_STMT]) . ' ';

                                break;

                                case 'NOT_LIKE':

                                    $condition = $condition[self::LEFT_STMT] . ' ' . $this->sql_not_like_expression($condition[self::RIGHT_STMT]) . ' ';

                                break;

                                case 'IS_NOT':

                                    $condition[self::COMPARE_OP] = 'IS NOT';

                                // no break
                                case 'IS':

                                    // If the value is NULL, the string of it is the empty string ('') which is not the intended result.
                                    // this should solve that
                                    if ($condition[self::RIGHT_STMT] === null)
                                    {
                                        $condition[self::RIGHT_STMT] = 'NULL';
                                    }

                                    $condition = implode(' ', $condition);

                                break;

                                default:

                                    $condition = implode(' ', $condition);

                                break;
                            }

                        break;

                        case 5:

                            // Subquery with {left hand} {operator} {compare kind} {SELECT Kind } {Sub Query}

                            $result = $condition[self::LEFT_STMT] . ' ' . $condition[self::COMPARE_OP] . ' ' . $condition[self::SUBQUERY_OP] . ' ( ';
                            $result .= $this->sql_build_query($condition[self::SUBQUERY_SELECT_TYPE], $condition[self::SUBQUERY_BUILD]);
                            $result .= ' )';
                            $condition = $result;

                        break;

                        default:
                            // This is an unpredicted clause setup. Just join all elements.
                            $condition = implode(' ', $condition);

                        break;
                    }

                break;
            }

        }

        if ($operation === 'NOT')
        {
            $operations_ary =  implode("", $operations_ary[self::STATEMENTS]);
        }
        else
        {
            $operations_ary = implode(" \n    $operation ", $operations_ary[self::STATEMENTS]);
        }

        return $operations_ary;
    }


    /**
    * {@inheritDoc}
    */
    function sql_error($sql = '')
    {
    }

    /**
     * Return sql error array
     *
     * @return array SQL error array with message and error code
     * @psalm-return array{message: string, code: int|string}
     */
    abstract protected function _sql_error(): array;

    /**
    * {@inheritDoc}
    */
    function sql_report($mode, $query = '')
    {
    }

    /**
     * Build db-specific report
     *
     * @param string $mode 'start' to add to report, 'fromcache' to output it
     * @param string $query Query to add to sql report
     *
     * @return void
     */
    abstract protected function _sql_report(string $mode, string $query = ''): void;

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
     * {@inheritDoc}
     */
    // public function clean_query_id(mixed $query_id): int|string|null
    public function clean_query_id($query_id)
    {
    }
}
