<?php
/**
 * CampaignId value object.
 *
 * @package Fundrik\Campaigns\Domain
 */

declare(strict_types=1);

namespace Fundrik\Campaigns\Domain;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

defined( 'ABSPATH' ) || die;

/**
 * Represents the campaign's ID.
 *
 * It can either be an positive integer or a valid UUID string.
 */
final readonly class CampaignId {

	/**
	 * CampaignId constructor.
	 *
	 * @param int|string $value Campaign ID (either an integer or UUID string).
	 */
	private function __construct(
		private int|string $value
	) {}

	/**
	 * Factory method to create a CampaignId instance from either int or string.
	 *
	 * @param int|string $id The ID (either integer or UUID string).
	 *
	 * @return self New instance of CampaignId.
	 *
	 * @throws InvalidArgumentException If the ID is neither int nor string, or is invalid.
	 */
	public static function create( int|string $id ): self {

		if ( is_int( $id ) ) {
			return self::from_int( $id );
		}

		if ( is_string( $id ) ) {
			return self::from_uuid( $id );
		}

		throw new InvalidArgumentException( 'ID must be int or UUID string' );
	}

	/**
	 * Factory method to create a CampaignId instance from an integer.
	 *
	 * @param int $id The integer ID.
	 *
	 * @return self New instance of CampaignId.
	 *
	 * @throws InvalidArgumentException If the integer ID is not positive.
	 */
	public static function from_int( int $id ): self {

		if ( $id <= 0 ) {
			throw new InvalidArgumentException( 'ID must be a positive integer' );
		}

		return new self( $id );
	}

	/**
	 * Factory method to create a CampaignId instance from a UUID string.
	 *
	 * @param string $uuid The UUID string.
	 *
	 * @return self New instance of CampaignId.
	 *
	 * @throws InvalidArgumentException If the UUID string is invalid.
	 */
	public static function from_uuid( string $uuid ): self {

		if ( ! Uuid::isValid( $uuid ) ) {
			throw new InvalidArgumentException( 'ID must be a valid UUID string' );
		}

		return new self( $uuid );
	}

	/**
	 * Convert CampaignId to a string.
	 *
	 * @return string The campaign ID.
	 */
	public function __toString(): string {

		return (string) $this->value;
	}
}
