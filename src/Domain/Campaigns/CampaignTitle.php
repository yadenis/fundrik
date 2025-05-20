<?php
/**
 * CampaignTitle value object.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Domain\Campaigns;

use InvalidArgumentException;

/**
 * Represents the campaign's title.
 *
 * This class ensures that the title is not empty or whitespace only.
 *
 * @since 1.0.0
 */
final readonly class CampaignTitle {

	/**
	 * CampaignTitle constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $value The campaign title.
	 *
	 * @throws InvalidArgumentException If the title is empty or whitespace.
	 */
	public function __construct(
		public string $value,
	) {

		if ( '' === trim( $value ) ) {
			throw new InvalidArgumentException( 'Campaign title cannot be empty or whitespace.' );
		}
	}
}
