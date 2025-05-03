<?php
/**
 * Platform abstraction interface for Fundrik.
 *
 * Defines a contract for platform-specific functionality that can be
 * implemented for WordPress or other environments to keep core logic decoupled.
 *
 * @package Fundrik\Infrastructure
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Infrastructure;

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
