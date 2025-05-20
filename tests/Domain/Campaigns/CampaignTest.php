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

		$id = 42;

		$campaign = new Campaign(
			id: EntityId::create( $id ),
			title:'Test Campaign',
			is_enabled: true,
			is_open:  false,
			target: new CampaignTarget( true, 1000 ),
		);

		$this->assertEquals( $id, $campaign->get_id() );
		$this->assertEquals( 'Test Campaign', $campaign->get_title() );
		$this->assertTrue( $campaign->is_enabled() );
		$this->assertFalse( $campaign->is_open() );
		$this->assertTrue( $campaign->has_target() );
		$this->assertEquals( 1000, $campaign->get_target_amount() );
	}

	#[Test]
	public function campaign_without_enabled_target(): void {

		$id = 123;

		$campaign = new Campaign(
			id: EntityId::create( $id ),
			title: 'Campaign Without Target',
			is_enabled: false,
			is_open: true,
			target: new CampaignTarget( false, 0 ),
		);

		$this->assertFalse( $campaign->has_target() );
		$this->assertEquals( 0, $campaign->get_target_amount() );
		$this->assertEquals( $id, $campaign->get_id() );
	}
}
