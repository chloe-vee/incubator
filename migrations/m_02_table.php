<?php

/**
 * Migration to add an admin control module.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\migrations;

class m_02_table extends \phpbb\db\migration\migration
{
    protected $table_name = "ra_incubator";

    /**
     * Create table and add module.
     *
     * See:
     *   - https://area51.phpbb.com/docs/dev/3.3.x/migrations/tools/module.html
     *
     * @return array
     */
    public function update_schema(): array
    {
        return [
            'add_tables'    => [
                $this->table_prefix . $this->table_name => [
                    'COLUMNS' => [
                        'from_forum_id' => ['UINT', null],
                        'to_forum_id'   => ['UINT', null],
                        'days'          => ['UINT', 30],
                    ],
                    'PRIMARY_KEY' => 'from_forum_id',
                ],
            ],
        ];
    }

    /**
     * Drop table.
     *
     * @return array
     */
    public function revert_schema(): array
    {
        return [
            'drop_tables'    => [
                $this->table_prefix . $this->table_name,
            ],
        ];
    }
}
