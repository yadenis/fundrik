<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Domain\Campaigns;

use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignDto;
use Fundrik\Core\Domain\Campaigns\CampaignFactory;
use Fundrik\Core\Domain\Campaigns\CampaignId;
use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass( CampaignFactory::class )]
#[UsesClass( Campaign::class )]
#[UsesClass( CampaignId::class )]
#[UsesClass( CampaignTarget::class )]
class CampaignFactoryTest extends TestCase {

	#[Test]
	public function creates_campaign_with_int_id() {

		$campaign = ( new CampaignFactory() )->create(
			id: 1,
			title: 'Test Campaign',
			slug: 'test-campaign',
			is_enabled: true,
			is_open: true,
			has_target: true,
			target_amount: 1000,
			collected_amount: 200
		);

		$this->assertInstanceOf( Campaign::class, $campaign );
		$this->assertEquals( 'Test Campaign', $campaign->title );
		$this->assertEquals( '1000', (string) $campaign->target );
	}

	#[Test]
	public function creates_campaign_with_uuid_id() {

		$uuid = '0196934d-e117-71aa-ab63-cff172292bd2';

		$campaign = ( new CampaignFactory() )->create(
			id: $uuid,
			title: 'UUID Campaign',
			slug: 'uuid-campaign',
			is_enabled: true,
			is_open: false,
			has_target: false,
			target_amount: 0,
			collected_amount: 0
		);

		$this->assertInstanceOf( Campaign::class, $campaign );
		$this->assertEquals( $uuid, (string) $campaign->id );
		$this->assertEquals( false, $campaign->is_open );
	}

	#[Test]
	public function throws_when_target_amount_zero_but_target_enabled() {

		$this->expectException( InvalidArgumentException::class );

		( new CampaignFactory() )->create(
			id: 1,
			title: 'Invalid Campaign',
			slug: 'invalid-campaign',
			is_enabled: true,
			is_open: true,
			has_target: true,
			target_amount: 0,
			collected_amount: 0
		);
	}

	#[Test]
	public function throws_when_target_amount_nonzero_but_target_disabled() {

		$this->expectException( InvalidArgumentException::class );

		( new CampaignFactory() )->create(
			id: 1,
			title: 'Invalid Campaign',
			slug: 'invalid-campaign',
			is_enabled: true,
			is_open: true,
			has_target: false,
			target_amount: 500,
			collected_amount: 0
		);
	}

	#[Test]
	public function throws_when_id_is_negative() {

		$this->expectException( InvalidArgumentException::class );

		( new CampaignFactory() )->create(
			id: -1,
			title: 'Invalid Campaign',
			slug: 'invalid-campaign',
			is_enabled: true,
			is_open: true,
			has_target: false,
			target_amount: 0,
			collected_amount: 0
		);
	}

	#[Test]
	public function creates_campaign_from_dto() {

		$dto = new CampaignDto(
			id: 42,
			title: 'DTO Campaign',
			slug: 'dto-campaign',
			is_enabled: true,
			is_open: true,
			has_target: true,
			target_amount: 1000,
			collected_amount: 400
		);

		$campaign = ( new CampaignFactory() )->from_dto( $dto );

		$this->assertInstanceOf( Campaign::class, $campaign );
		$this->assertEquals( 'DTO Campaign', $campaign->title );
		$this->assertEquals( '1000', (string) $campaign->target );
		$this->assertEquals( 400, $campaign->collected_amount );
	}
}
