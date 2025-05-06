<?php
/**
 * WpdbCampaignRepository class.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Infrastructure\Persistence;

use Fundrik\Application\Campaigns\CampaignDtoFactory;
use Fundrik\Domain\Campaigns\CampaignDto;
use Fundrik\Domain\Campaigns\CampaignId;
use Fundrik\Domain\Campaigns\Interfaces\CampaignRepositoryInterface;
use Fundrik\Domain\Campaigns\Interfaces\QueryExecutorInterface;

/**
 * Repository for managing campaigns in the WordPress database using wpdb.
 *
 * @since 1.0.0
 */
final readonly class WpdbCampaignRepository implements CampaignRepositoryInterface {

	private const TABLE = 'fundrik_campaigns';

	/**
	 * WpdbCampaignRepository constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param CampaignDtoFactory     $dto_factory The factory to create CampaignDto objects from database data.
	 * @param QueryExecutorInterface $query_executor The query executor to interact with the database.
	 */
	public function __construct(
		private CampaignDtoFactory $dto_factory,
		private QueryExecutorInterface $query_executor
	) {
	}

	/**
	 * Get a campaign by its ID.
	 *
	 * @since 1.0.0
	 *
	 * @param CampaignId $id The campaign ID.
	 *
	 * @return CampaignDto|null The campaign DTO if found, or null if not found.
	 */
	public function get_by_id( CampaignId $id ): ?CampaignDto {

		$data = $this->query_executor->get_by_id( self::TABLE, $id->value );

		return $data ? $this->dto_factory->from_array( $data ) : null;
	}

	/**
	 * Get all campaigns.
	 *
	 * @since 1.0.0
	 *
	 * @return CampaignDto[] An array of campaign DTOs.
	 */
	public function get_all(): array {

		$data = $this->query_executor->get_all( self::TABLE );

		return array_map(
			fn( $item ): CampaignDto => $this->dto_factory->from_array( $item ),
			$data
		);
	}
}
