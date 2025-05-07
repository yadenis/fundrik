<?php
/**
 * Interface for executing raw SQL queries.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Domain\Campaigns\Interfaces;

interface QueryExecutorInterface {

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
	public function get_by_id( string $table, int|string $id ): ?array;

	/**
	 * Retrieves all rows from the given table.
	 *
	 * @since 1.0.0
	 *
	 * @param string $table The name of the table.
	 *
	 * @return array<int,array<string,mixed>> An array of rows as associative arrays.
	 */
	public function get_all( string $table ): array;
}
