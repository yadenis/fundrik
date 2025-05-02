<?php
/**
 * CampaignId class.
 *
 * @package Fundrik\Campaigns\Domain
 */

declare(strict_types=1);

namespace Fundrik\Campaigns\Domain;

defined( 'ABSPATH' ) || die;

/**
 * Represents a campaign.
 *
 * It is used for managing the campaign data.
 */
final readonly class Campaign {

	/**
	 * Campaign constructor.
	 *
	 * @param CampaignId     $id Campaign ID (can be either int or UUID).
	 * @param string         $title Campaign title.
	 * @param bool           $is_open Flag indicating if the campaign is open.
	 * @param CampaignTarget $target Campaign target (enabled status and amount).
	 * @param int            $collected_amount Amount collected for the campaign.
	 */
	public function __construct(
		public CampaignId $id,
		public string $title,
		public bool $is_open,
		public CampaignTarget $target,
		public int $collected_amount
	) {
	}
}
