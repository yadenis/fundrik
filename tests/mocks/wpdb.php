<?php

declare(strict_types=1);

if ( ! class_exists( 'wpdb' ) ) {

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedConstantFound
	define( 'ARRAY_A', 'ARRAY_A' );

	/**
	 * Mock of the WordPress wpdb class for testing.
	 *
	 * In a real environment, this class is responsible for interacting with the WordPress database using
	 * the database access object. However, for testing purposes, we provide a simple mock implementation
	 * that returns predefined results based on the expectations set in the test.
	 */
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound,PEAR.NamingConventions.ValidClassName.StartWithCapital
	class wpdb {

		/**
		 * Mock of the prepare method from wpdb.
		 *
		 * In the real wpdb, this method prepares a SQL query for execution, ensuring safety from SQL injection.
		 * For testing, it returns the query string as is.
		 *
		 * @param mixed ...$args Arguments.
		 */
		public function prepare( ...$args ) {}

		/**
		 * Mock of the get_row method from wpdb.
		 *
		 * In the real wpdb, this method retrieves a single row from the database based on the query.
		 * For testing, it returns predefined data.
		 *
		 * @param mixed ...$args Arguments.
		 */
		public function get_row( ...$args ) {}

		/**
		 * Mock of the get_results method from wpdb.
		 *
		 * In the real wpdb, this method retrieves multiple rows from the database based on the query.
		 * For testing, it returns predefined data.
		 *
		 * @param mixed ...$args Arguments.
		 */
		public function get_results( ...$args ) {}
	}
}
