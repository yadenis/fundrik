<?php
/**
 * Helper functions for Fundrik plugin.
 *
 * @package Fundrik\Bootstrap
 *
 * @since 1.0.0
 */

declare(strict_types=1);

use Fundrik\Infrastructure\Container;
use Fundrik\Infrastructure\Platforms\PlatformInterface;

/**
 * Retrieves the Fundrik container instance.
 *
 * This function ensures that only one instance of the container is created
 * and reused throughout the plugin.
 *
 * @since 1.0.0
 *
 * @return Container The instance of the Fundrik container.
 */
function fundrik(): Container {

	static $container = null;

	if ( null === $container ) {
		$container = new Container();
	}

	return $container;
}

/**
 * Escape output using platform-agnostic method.
 *
 * Used by PHPCS as custom escaping function.
 *
 * @since 1.0.0
 *
 * @param string $text Raw text to be escaped.
 *
 * @return string Escaped HTML-safe string.
 */
function fundrik_escape_html( string $text ): string {

	return fundrik()->get( PlatformInterface::class )->escape_html( $text );
}
