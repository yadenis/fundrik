<?php
/**
 * CampaignId value object.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Domain\Campaigns;

use InvalidArgumentException;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;

/**
 * Represents the campaign's ID.
 *
 * It can either be an positive integer or a valid UUID string.
 *
 * @since 1.0.0
 */
final readonly class CampaignId {

	/**
	 * CampaignId constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param int|string $value Campaign ID (either an integer or UUID string).
	 */
	private function __construct(
		public int|string $value
	) {}

	/**
	 * Factory method to create a CampaignId instance from either int or string.
	 *
	 * @since 1.0.0
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

		// @codeCoverageIgnoreStart
		throw new InvalidArgumentException( 'CampaignId must be int or UUID string' );
		// @codeCoverageIgnoreEnd
	}

	/**
	 * Factory method to create a CampaignId instance from an integer.
	 *
	 * @since 1.0.0
	 *
	 * @param int $id The integer ID.
	 *
	 * @return self New instance of CampaignId.
	 *
	 * @throws InvalidArgumentException If the integer ID is not positive.
	 */
	public static function from_int( int $id ): self {

		if ( $id <= 0 ) {
			throw new InvalidArgumentException( 'CampaignId must be a positive integer' );
		}

		return new self( $id );
	}

	/**
	 * Factory method to create a CampaignId instance from a UUID string.
	 *
	 * @since 1.0.0
	 *
	 * @param string $uuid The UUID string.
	 *
	 * @return self New instance of CampaignId.
	 *
	 * @throws InvalidArgumentException If the UUID string is invalid.
	 */
	public static function from_uuid( string $uuid ): self {

		try {
			return new self( (string) Uuid::fromString( $uuid ) );
		} catch ( InvalidUuidStringException $e ) {
			throw new InvalidArgumentException(
				message: 'CampaignId must be a valid UUID string.',
				previous: $e
			);
		}
	}

	/**
	 * Convert CampaignId to a string.
	 *
	 * @since 1.0.0
	 *
	 * @return string The campaign ID.
	 */
	public function __toString(): string {

		return (string) $this->value;
	}
}
