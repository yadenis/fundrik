<?php
/**
 * CampaignDtoFactory class.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Application\Campaigns;

use Fundrik\Core\Domain\Campaigns\Campaign;

/**
 * Factory for creating CampaignDto objects from trusted data arrays.
 *
 * Assumes data has already been validated or is trusted (no checks performed).
 *
 * @since 1.0.0
 */
final readonly class CampaignDtoFactory {

	/**
	 * Create a CampaignDto from an associative array of data.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Associative array with keys:
	 *                    - id               (int|string)
	 *                    - title            (string)
	 *                    - is_enabled       (bool)
	 *                    - is_open          (bool)
	 *                    - has_target       (bool)
	 *                    - target_amount    (int).
	 *
	 * @return CampaignDto A DTO representing the campaign data.
	 */
	public function from_array( array $data ): CampaignDto {

		return new CampaignDto(
			id: $data['id'],
			title: $data['title'],
			is_enabled: $data['is_enabled'],
			is_open: $data['is_open'],
			has_target: $data['has_target'],
			target_amount: $data['target_amount'],
		);
	}

	/**
	 * Create a CampaignDto from a Campaign.
	 *
	 * @since 1.0.0
	 *
	 * @param Campaign $campaign The Campaign entity.
	 *
	 * @return CampaignDto A DTO representing the campaign.
	 */
	public function from_campaign( Campaign $campaign ): CampaignDto {

		return new CampaignDto(
			id: $campaign->get_id(),
			title: $campaign->get_title(),
			is_enabled: $campaign->is_enabled(),
			is_open: $campaign->is_open(),
			has_target: $campaign->has_target(),
			target_amount: $campaign->get_target_amount(),
		);
	}
}
