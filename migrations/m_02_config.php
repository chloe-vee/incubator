<?php

/**
 * Add config values.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\migrations;

class m_02_config extends \phpbb\db\migration\migration
{
    /**
     * Relies on phpBB's migration v314.
     *
     * @return array
     */
    public static function depends_on(): array
    {
        return ['\phpbb\db\migration\data\v31x\v314'];
    }

    /**
     * Skip migration if the config already exists.
     *
     * @return bool
     */
    public function effectively_installed(): bool
    {
        return isset($this->config["relocate_ripe_topics_gc"]);
    }

    /**
     * Add the module to the database.
     *
     * See:
     *   - https://area51.phpbb.com/docs/dev/3.3.x/migrations/tools/config.html
     *
     * @return array
     */
    public function update_data(): array
    {

        return [
            ["config.add", ["incubator_from_forum", ""]],
            ["config.add", ["incubator_to_forum", ""]],
            ["config.add", ["incubator_days", ""]],
            ["config.add", ["relocate_ripe_topics_last_gc", 0]],

            // run the cron every day
            ["config.add", ["relocate_ripe_topics_gc", 86400]],
        ];
    }
}
