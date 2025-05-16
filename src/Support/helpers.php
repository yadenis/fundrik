<?php
/**
 * Helper functions for Fundrik plugin.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

use Fundrik\Core\Infrastructure\Internal\Container;
use Fundrik\Core\Infrastructure\Internal\ContainerManager;

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
