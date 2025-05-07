<?php
/**
 * Interface for abstracting platform-specific utilities.
 *
 * Provides a contract for implementing core utility behaviors,
 * allowing the rest of the application to remain decoupled from the underlying platform.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Infrastructure\Platforms\Interfaces;

interface PlatformInterface {

	/**
	 * Escape a string for safe HTML output.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Raw text to be escaped.
	 *
	 * @return string Escaped HTML-safe string.
	 */
	public function escape_html( string $text ): string;
}
