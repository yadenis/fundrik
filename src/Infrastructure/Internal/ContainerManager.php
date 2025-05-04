<?php
/**
 * ContainerManager class for managing Fundrik's DI container.
 *
 * @package Fundrik\Infrastructure\Internal
 *
 * @since 1.0.0
 *
 * @internal
 */

declare(strict_types=1);

namespace Fundrik\Infrastructure\Internal;

/**
 * Manages a singleton instance of the Fundrik container.
 *
 * Used internally to provide global access to the container,
 * especially in non-OO contexts like helper functions.
 *
 * @since 1.0.0
 *
 * @internal
 */
final class ContainerManager {

	/**
	 * The shared container instance.
	 *
	 * @var Container|null
	 */
	private static ?Container $container = null;

	/**
	 * Returns the current container instance.
	 *
	 * If the container has not been set, a new one is created.
	 *
	 * @since 1.0.0
	 *
	 * @return Container
	 */
	public static function get(): Container {

		if ( null === self::$container ) {
			self::$container = new Container();
		}

		return self::$container;
	}

	/**
	 * Sets the container instance.
	 *
	 * Used primarily in tests to inject a custom container.
	 *
	 * @since 1.0.0
	 *
	 * @param Container $container The container instance to set.
	 */
	public static function set( Container $container ): void {

		self::$container = $container;
	}
}
