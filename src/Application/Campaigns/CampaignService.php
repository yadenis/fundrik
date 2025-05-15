<?php
/**
 * Provides the application-level service for managing campaign retrieval.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Application\Campaigns;

use Fundrik\Core\Application\Interfaces\EntityServiceInterface;
use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignDto;
use Fundrik\Core\Domain\Campaigns\CampaignFactory;
use Fundrik\Core\Domain\Campaigns\Interfaces\CampaignRepositoryInterface;
use Fundrik\Core\Domain\EntityId;
use Fundrik\Core\Domain\Interfaces\EntityDto;

/**
 * Application service for coordinating access to campaign data and behavior.
 *
 * @since 1.0.0
 */
final readonly class CampaignService implements EntityServiceInterface {

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
	 * @param EntityId $id The campaign ID.
	 *
	 * @return Campaign|null The campaign if found, or null if not found.
	 */
	public function get_by_id( EntityId $id ): ?Campaign {

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
	public function get_all(): array {

		$dto_list = $this->repository->get_all();

		return array_map(
			fn( $dto ): Campaign => $this->factory->from_dto( $dto ),
			$dto_list
		);
	}

	/**
	 * Save a campaign (create or update).
	 *
	 * @param CampaignDto $dto The campaign DTO to save.
	 */
	public function save( EntityDto $dto ): bool {

		$campaign = $this->factory->from_dto( $dto );

		return $this->repository->exists( $campaign )
			? $this->repository->update( $campaign )
			: $this->repository->insert( $campaign );
	}

	public function delete( EntityId $id ): bool {

		return $this->repository->delete( $id );
	}
}
