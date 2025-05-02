<?php
/**
 * Factory class for creating Campaign instances.
 *
 * @package Fundrik\Campaigns\Domain
 */

declare(strict_types=1);

namespace Fundrik\Campaigns\Domain;

defined( 'ABSPATH' ) || die;

/**
 * Responsible for creating Campaign instances.
 *
 * It validates input data and ensures that the Campaign is correctly initialized.
 */
final readonly class CampaignFactory {

	/**
	 * Create a new Campaign instance.
	 *
	 * @param int|string $id Campaign ID, can be either an integer or a UUID string.
	 * @param string     $title Campaign title.
	 * @param bool       $is_open Flag indicating if the campaign is open.
	 * @param bool       $has_target Flag indicating if the campaign has a target.
	 * @param int        $target_amount Target amount for the campaign.
	 *                                  Required if has_target is true, otherwise must be 0.
	 * @param int        $collected_amount Amount collected for the campaign.
	 *
	 * @return Campaign A new instance of the Campaign class.
	 */
	public function create(
		int|string $id,
		string $title,
		bool $is_open,
		bool $has_target,
		int $target_amount = 0,
		int $collected_amount
	): Campaign {

		$id     = CampaignId::create( $id );
		$target = new CampaignTarget( $has_target, $target_amount );

		$campaign = new Campaign(
			id: $id,
			title: $title,
			is_open: $is_open,
			target: $target,
			collected_amount: $collected_amount
		);

		return $campaign;
	}
}
