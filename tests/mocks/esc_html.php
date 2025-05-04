<?php

declare(strict_types=1);

if ( ! function_exists( 'esc_html' ) ) {

	/**
	 * Mock of the WordPress esc_html() function for testing.
	 *
	 * In a real environment, this string would be escaped for safe HTML output.
	 * However, for testing purposes, we return the string as is with a funny rabbit phrase.
	 *
	 * @param string $text Input text.
	 *
	 * @return string Escaped text.
	 */
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound
	function esc_html( string $text ): string {

		return "The funny white rabbit escaped this string and here is: {$text}";
	}
}
