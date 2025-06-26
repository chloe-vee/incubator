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

class m_01_module extends \phpbb\db\migration\migration
{
    /**
     * Relies on migration phpBB's migration v314.
     *
     * @return array
     */
    public static function depends_on(): array
    {
        return ['\phpbb\db\migration\data\v31x\v314'];
    }

    /**
     * Add the module to the database.
     *
     * See:
     *   - https://area51.phpbb.com/docs/dev/3.3.x/migrations/tools/module.html
     *
     * @return array
     */
    public function update_data(): array
    {

        return [
            ["module.add", [
                "acp",
                "ACP_CAT_DOT_MODS",
                "ACP_INCUBATOR_NAME",
            ]],

            ["module.add", [
                "acp",
                "ACP_INCUBATOR_NAME",
                [
                    "module_basename" => '\ra\incubator\acp\main_module',
                    "modes" => ["settings"],
                ],
            ]],
        ];
    }
}
