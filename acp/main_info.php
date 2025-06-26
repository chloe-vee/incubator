<?php

/**
 * Admin control panel module info.
 *
 * PHP version 5+
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

namespace ra\incubator\acp;

/**
 * Information about this module.
 */
class main_info
{
    /**
     * Return module info.
     *
     * @return array
     */
    public function module(): array
    {
        return [
            "filename" => '\ra\incubator\acp\main_info',
            "title" => "ACP_INCUBATOR_NAME",
            "modes" => [
                "settings" => [
                    "title" => "ACP_INCUBATOR_SETTINGS",
                    "auth" => "ext_ra/incubator && acl_a_board",
                    "cat" => ["ACP_INCUBATOR_NAME"],
                ],
            ],
        ];
    }
}
