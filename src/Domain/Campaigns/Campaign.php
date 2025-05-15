<?php
/**
 * Campaign class.
 *
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Fundrik\Core\Domain\Campaigns;

use Fundrik\Core\Domain\EntityId;
use Fundrik\Core\Domain\Interfaces\Entity;

/**
 * Represents a campaign.
 *
 * It is used for managing the campaign data.
 *
 * @since 1.0.0
 *
 * @codeCoverageIgnore
 */
final readonly class Campaign implements Entity {

	/**
	 * Campaign constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param EntityId       $id Campaign ID (can be either int or UUID).
	 * @param string         $title Campaign title.
	 * @param string         $slug URL-friendly identifier for the campaign.
	 * @param bool           $is_enabled Flag indicating if the campaign is enabled (visible and accessible).
	 * @param bool           $is_open Flag indicating if the campaign is open.
	 * @param CampaignTarget $target Campaign target (enabled status and amount).
	 * @param int            $collected_amount Amount collected for the campaign.
	 */
	public function __construct(
		public EntityId $id,
		public string $title,
		public string $slug,
		public bool $is_enabled,
		public bool $is_open,
		public CampaignTarget $target,
		public int $collected_amount
	) {
	}
}
