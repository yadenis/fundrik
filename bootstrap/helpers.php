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
