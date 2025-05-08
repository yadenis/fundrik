<?php
/**
 * Interface for platform integration.
 *
 * This is the single point of entry the core relies on
 * to launch the platform layer.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Infrastructure\Platform\Interfaces;

interface PlatformInterface {

	/**
	 * Initialize the platform.
	 *
	 * Called by the core to trigger platform-specific setup.
	 *
	 * @since 1.0.0
	 */
	public function init(): void;
}
