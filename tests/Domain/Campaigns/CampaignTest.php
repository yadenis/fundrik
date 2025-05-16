<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Domain\Campaigns;

use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use Fundrik\Core\Domain\EntityId;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass( Campaign::class )]
#[UsesClass( CampaignTarget::class )]
#[UsesClass( EntityId::class )]
final class CampaignTest extends TestCase {

	#[Test]
	public function campaign_returns_all_expected_values(): void {

		$id         = EntityId::create( 42 );
		$title      = 'Test Campaign';
		$is_enabled = true;
		$is_open    = false;
		$target     = new CampaignTarget( true, 1000 );

		$campaign = new Campaign(
			id: $id,
			title: $title,
			is_enabled: $is_enabled,
			is_open: $is_open,
			target: $target
		);

		$this->assertEquals( 42, $campaign->get_id() );
		$this->assertEquals( 'Test Campaign', $campaign->get_title() );
		$this->assertTrue( $campaign->is_enabled() );
		$this->assertFalse( $campaign->is_open() );
		$this->assertTrue( $campaign->has_target() );
		$this->assertEquals( 1000, $campaign->get_target_amount() );
	}

	#[Test]
	public function campaign_without_enabled_target(): void {

		$id     = EntityId::create( 123 );
		$target = new CampaignTarget( false, 0 );

		$campaign = new Campaign(
			id: $id,
			title: 'Hidden Target Campaign',
			is_enabled: false,
			is_open: true,
			target: $target
		);

		$this->assertFalse( $campaign->has_target() );
		$this->assertEquals( 0, $campaign->get_target_amount() );
		$this->assertEquals( 123, $campaign->get_id() );
	}
}
