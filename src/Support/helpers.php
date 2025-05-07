<?php
/**
 * Helper functions for Fundrik plugin.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

use Fundrik\Core\Infrastructure\Internal\Container;
use Fundrik\Core\Infrastructure\Internal\ContainerManager;
use Fundrik\Core\Infrastructure\Platforms\Interfaces\PlatformInterface;

/**
 * Retrieves the Fundrik container instance.
 *
 * This function provides access to the Fundrik dependency injection container.
 * The container is managed internally and reused across the plugin lifecycle.
 *
 * @since 1.0.0
 *
 * @return Container The instance of the Fundrik container.
 */
function fundrik(): Container {

	return ContainerManager::get();
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
