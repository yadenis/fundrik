<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Application\Campaigns;

use Fundrik\Core\Application\Campaigns\CampaignService;
use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignDto;
use Fundrik\Core\Domain\Campaigns\CampaignFactory;
use Fundrik\Core\Domain\Campaigns\CampaignId;
use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use Fundrik\Core\Domain\Campaigns\Interfaces\CampaignRepositoryInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

#[CoversClass( CampaignService::class )]
#[UsesClass( CampaignFactory::class )]
#[UsesClass( CampaignId::class )]
#[UsesClass( CampaignTarget::class )]
class CampaignServiceTest extends TestCase {

	private CampaignRepositoryInterface&MockObject $repository;

	private CampaignService $service;

	protected function setUp(): void {

		parent::setUp();

		$this->repository = $this->createMock( CampaignRepositoryInterface::class );

		$this->service = new CampaignService(
			new CampaignFactory(),
			$this->repository
		);
	}

	#[Test]
	public function get_campaign_by_id_returns_campaign() {

		$campaign_id = CampaignId::from_int( 123 );

		$dto = new CampaignDto(
			id               : 123,
			title            : 'Array Campaign',
			slug             : 'array-campaign',
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$this->repository
			->expects( $this->once() )
			->method( 'get_by_id' )
			->with( $this->identicalTo( $campaign_id ) )
			->willReturn( $dto );

		$result = $this->service->get_campaign_by_id( $campaign_id );

		$this->assertInstanceOf( Campaign::class, $result );
	}

	#[Test]
	public function get_campaign_by_id_returns_null_when_not_found() {

		$campaign_id = CampaignId::from_int( 999 );

		$this->repository
			->expects( $this->once() )
			->method( 'get_by_id' )
			->with( $this->identicalTo( $campaign_id ) )
			->willReturn( null );

		$result = $this->service->get_campaign_by_id( $campaign_id );

		$this->assertNull( $result );
	}

	#[Test]
	public function get_all_campaigns_returns_list_of_campaigns() {

		$dto1 = new CampaignDto(
			id               : 123,
			title            : 'Campaign One',
			slug             : 'campaign-one',
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$dto2 = new CampaignDto(
			id               : 124,
			title            : 'Campaign Two',
			slug             : 'campaign-two',
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$this->repository
			->expects( $this->once() )
			->method( 'get_all' )
			->willReturn( [ $dto1, $dto2 ] );

		$result = $this->service->get_all_campaigns();

		$this->assertCount( 2, $result );

		$this->assertInstanceOf( Campaign::class, $result[0] );
		$this->assertSame( 'Campaign One', $result[0]->title );

		$this->assertInstanceOf( Campaign::class, $result[1] );
		$this->assertSame( 'Campaign Two', $result[1]->title );
	}
}
