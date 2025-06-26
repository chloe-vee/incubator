<?php

/**
 * Language token definitions.
 *
 * PHP version 5
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

if (!defined("IN_PHPBB")) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
    $lang = [];
}

$lang = array_merge(
    $lang,
    array(
        "ACP_INCUBATOR_NAME"        => "Incubator Module",
        "ACP_INCUBATOR_SETTINGS"    => "Settings",
        "ACP_INCUBATOR_SUCCESS"     => "Settings saved.",
    ),
);
