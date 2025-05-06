<?php
/**
 * Interface for the Campaign repository.
 *
 * Defines methods for interacting with the campaign repository.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Domain\Campaigns\Interfaces;

use Fundrik\Domain\Campaigns\CampaignDto;
use Fundrik\Domain\Campaigns\CampaignId;

interface CampaignRepositoryInterface {

	/**
	 * Get a campaign by its ID.
	 *
	 * @since 1.0.0
	 *
	 * @param CampaignId $id The campaign ID.
	 *
	 * @return CampaignDto|null The campaign DTO if found, or null if not found.
	 */
	public function get_by_id( CampaignId $id ): ?CampaignDto;

	/**
	 * Get all campaigns.
	 *
	 * @since 1.0.0
	 *
	 * @return CampaignDto[] An array of campaign DTOs.
	 */
	public function get_all(): array;
}
