<?php
/**
 * WpdbQueryExecutor class.
 *
 * A wrapper around wpdb.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Infrastructure\Persistence;

use Fundrik\Domain\Campaigns\Interfaces\QueryExecutorInterface;
use wpdb;

/**
 * Executes safe SQL queries using WordPress's wpdb instance.
 *
 * @since 1.0.0
 */
final readonly class WpdbQueryExecutor implements QueryExecutorInterface {

	/**
	 * WpdbQueryExecutor constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param wpdb $db The WordPress database access object.
	 */
	public function __construct( private wpdb $db ) {}

	/**
	 * Retrieves a row from the given table by its ID.
	 *
	 * @since 1.0.0
	 *
	 * @param string     $table The name of the table.
	 * @param int|string $id    The value of the primary key (integer or UUID).
	 *
	 * @return array<string,mixed>|null The result as an associative array, or null if not found.
	 */
	public function get_by_id( string $table, int|string $id ): ?array {

		$placeholder = is_int( $id ) ? '%d' : '%s';

		$sql   = "SELECT * FROM %i WHERE id = {$placeholder} LIMIT 1";
		$query = $this->db->prepare( $sql, $table, $id );

		return $this->db->get_row( $query, ARRAY_A );
	}

	/**
	 * Retrieves all rows from the given table.
	 *
	 * @since 1.0.0
	 *
	 * @param string $table The name of the table.
	 *
	 * @return array<int,array<string,mixed>> An array of rows as associative arrays.
	 */
	public function get_all( string $table ): array {

		$sql   = 'SELECT * FROM %i';
		$query = $this->db->prepare( $sql, $table );

		return $this->db->get_results( $query, ARRAY_A );
	}
}
