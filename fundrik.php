<?php
/**
 * Fundrik
 *
 * @author Denis Yanchevskiy
 * @copyright 2025
 * @license GPLv2+
 *
 * @since 1.0.0
 *
 * Plugin Name: Fundrik
 * Plugin URI: https://fundrik.ru
 * Description: Fundraising solution for WordPress
 * Version: 1.0.0
 * Author: Denis Yanchevskiy
 * Author URI: https://denisco.pro
 * License: GPLv2 or later
 * Text Domain: fundrik
 */

declare(strict_types=1);

defined( 'ABSPATH' ) || die;

/**
 * Initializes the Fundrik plugin.
 *
 * @since 1.0.0
 */
function fundrik_init(): void {

	require_once __DIR__ . '/vendor/autoload.php';
}

add_action( 'plugins_loaded', fundrik_init( ... ) );
