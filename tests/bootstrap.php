<?php

/**
 * Test bootstrap file.
 *
 * PHP version 5
 *
 * @category Phpbb
 * @package  PhpBB_RA_Incubator_Tests
 * @author   Chloe Vee
 * @license  http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
 */

// ignore deprecation warnings from vendor code
error_reporting(E_ALL & ~E_DEPRECATED);

const TEST_ROOT = __DIR__;

require_once TEST_ROOT . DIRECTORY_SEPARATOR . "helpers.php";

define("TOPICS_TABLE", "phpbb_topics");
define("TABLE_PREFIX", "phpbb_");
