<?php
/**
 * CampaignDtoFactory class.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Application\Campaigns;

use Fundrik\Core\Domain\Campaigns\CampaignDto;

/**
 * Factory for creating CampaignDto objects from trusted data arrays.
 *
 * Assumes data has already been validated or is trusted (no checks performed).
 *
 * @since 1.0.0
 */
final readonly class CampaignDtoFactory {

	/**
	 * Create a CampaignDto instance from an associative array of data.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Associative array with keys:
	 *                    - id               (int|string)
	 *                    - title            (string)
	 *                    - slug             (string)
	 *                    - is_enabled       (bool)
	 *                    - is_open          (bool)
	 *                    - has_target       (bool)
	 *                    - target_amount    (int)
	 *                    - collected_amount (int).
	 *
	 * @return CampaignDto A DTO representing the campaign data.
	 */
	public function from_array( array $data ): CampaignDto {

		return new CampaignDto(
			id: $data['id'],
			title: $data['title'],
			slug: $data['slug'],
			is_enabled: $data['is_enabled'],
			is_open: $data['is_open'],
			has_target: $data['has_target'],
			target_amount: $data['target_amount'],
			collected_amount: $data['collected_amount']
		);
	}
}
