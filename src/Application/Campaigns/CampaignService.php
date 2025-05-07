<?php
/**
 * Provides the application-level service for managing campaign retrieval.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Application\Campaigns;

use Fundrik\Domain\Campaigns\Campaign;
use Fundrik\Domain\Campaigns\CampaignFactory;
use Fundrik\Domain\Campaigns\CampaignId;
use Fundrik\Domain\Campaigns\Interfaces\CampaignRepositoryInterface;

/**
 * Application service for coordinating access to campaign data and behavior.
 *
 * @since 1.0.0
 */
final readonly class CampaignService {

	/**
	 * CampaignService constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param CampaignFactory             $factory Factory to create Campaign objects from DTOs.
	 * @param CampaignRepositoryInterface $repository Repository to retrieve campaign DTOs from the database.
	 */
	public function __construct(
		private CampaignFactory $factory,
		private CampaignRepositoryInterface $repository
	) {}

	/**
	 * Get a campaign by its ID.
	 *
	 * @since 1.0.0
	 *
	 * @param CampaignId $id The campaign ID.
	 *
	 * @return Campaign|null The campaign if found, or null if not found.
	 */
	public function get_campaign_by_id( CampaignId $id ): ?Campaign {

		$campaign_dto = $this->repository->get_by_id( $id );

		return $campaign_dto ? $this->factory->from_dto( $campaign_dto ) : null;
	}

	/**
	 * Get all campaigns.
	 *
	 * @since 1.0.0
	 *
	 * @return Campaign[] An array of campaigns.
	 */
	public function get_all_campaigns(): array {

		$dto_list = $this->repository->get_all();

		return array_map(
			fn( $dto ): Campaign => $this->factory->from_dto( $dto ),
			$dto_list
		);
	}
}
