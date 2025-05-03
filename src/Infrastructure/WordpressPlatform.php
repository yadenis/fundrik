<?php
/**
 * WordPress platform adapter for Fundrik.
 *
 * @package Fundrik\Infrastructure
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Infrastructure;

/**
 * WordPress-specific implementation of platform abstraction.
 *
 * Provides utilities that rely on WordPress core functions, allowing
 * the rest of the plugin to remain decoupled from the platform.
 *
 * @since 1.0.0
 */
final readonly class WordpressPlatform implements PlatformInterface {

	/**
	 * Escape a string for safe HTML output using WordPress core function.
	 *
	 * @since 1.0.0
	 *
	 * @param string $text Raw text to be escaped.
	 *
	 * @return string Escaped HTML-safe string.
	 */
	public function escape_html( string $text ): string {

		return esc_html( $text );
	}
}
