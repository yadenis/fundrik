<?php
/**
 * CampaignTarget value object.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Domain\Campaigns;

use InvalidArgumentException;

/**
 * Represents the campaign's target status and amount.
 *
 * This class ensures that the target amount is set only when targeting is enabled,
 * and that it is zero when targeting is disabled.
 *
 * @since 1.0.0
 */
final readonly class CampaignTarget {

	/**
	 * CampaignTarget constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $is_enabled Flag indicating whether targeting is enabled.
	 * @param int  $amount The target amount (if targeting is enabled).
	 *
	 * @throws InvalidArgumentException If target is enabled but amount is zero,
	 *                                  or if target is disabled but amount is non-zero.
	 */
	public function __construct(
		public bool $is_enabled,
		public int $amount,
	) {

		if ( $is_enabled && $amount <= 0 ) {
			throw new InvalidArgumentException( "Target amount must be positive when targeting is enabled, given {$amount}" );
		}

		if ( ! $is_enabled && 0 !== $amount ) {
			throw new InvalidArgumentException( "Target amount should be zero when targeting is disabled, given {$amount}" );
		}
	}

	/**
	 * Convert CampaignTarget to a string (target amount).
	 *
	 * @since 1.0.0
	 *
	 * @return string The target amount.
	 */
	public function __toString(): string {

		return (string) $this->amount;
	}
}
