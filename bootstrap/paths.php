<?php
/**
 * Defines core path and URL constants for Fundrik.
 *
 * @package Fundrik\Bootstrap
 *
 * @since 1.0.0
 */

declare(strict_types=1);

define( 'FUNDRIK_MAIN_FILE', __DIR__ . '/../fundrik.php' );
define( 'FUNDRIK_PATH', plugin_dir_path( FUNDRIK_MAIN_FILE ) );
define( 'FUNDRIK_URL', plugin_dir_url( FUNDRIK_MAIN_FILE ) );
define( 'FUNDRIK_BASENAME', plugin_basename( FUNDRIK_MAIN_FILE ) );
