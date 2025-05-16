<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Application\Campaigns;

use Fundrik\Core\Application\Campaigns\CampaignDto;
use Fundrik\Core\Application\Campaigns\CampaignService;
use Fundrik\Core\Application\Campaigns\Interfaces\CampaignRepositoryInterface;
use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignFactory;
use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use Fundrik\Core\Domain\EntityId;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass( CampaignService::class )]
#[UsesClass( CampaignFactory::class )]
#[UsesClass( CampaignTarget::class )]
#[UsesClass( EntityId::class )]
class CampaignServiceTest extends TestCase {

	private CampaignRepositoryInterface&MockInterface $repository;

	private CampaignService $service;

	protected function setUp(): void {

		parent::setUp();

		$this->repository = Mockery::mock( CampaignRepositoryInterface::class );

		$this->service = new CampaignService(
			new CampaignFactory(),
			$this->repository
		);
	}

	#[Test]
	public function get_by_id_returns_campaign(): void {

		$campaign_id = EntityId::create( 123 );

		$dto = new CampaignDto(
			id               : 123,
			title            : 'Array Campaign',
			slug             : 'array-campaign',
			is_enabled       : true,
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$this->repository
			->shouldReceive( 'get_by_id' )
			->once()
			->with( $this->identicalTo( $campaign_id ) )
			->andReturn( $dto );

		$result = $this->service->get_campaign_by_id( $campaign_id );

		$this->assertInstanceOf( Campaign::class, $result );
	}

	#[Test]
	public function get_by_id_returns_null_when_not_found(): void {

		$campaign_id = EntityId::create( 999 );

		$this->repository
			->shouldReceive( 'get_by_id' )
			->once()
			->with( $this->identicalTo( $campaign_id ) )
			->andReturn( null );

		$result = $this->service->get_campaign_by_id( $campaign_id );

		$this->assertNull( $result );
	}

	#[Test]
	public function get_all_campaigns_returns_list_of_campaigns(): void {

		$dto1 = new CampaignDto(
			id               : 123,
			title            : 'Campaign One',
			slug             : 'campaign-one',
			is_enabled       : true,
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$dto2 = new CampaignDto(
			id               : 124,
			title            : 'Campaign Two',
			slug             : 'campaign-two',
			is_enabled       : true,
			is_open          : true,
			has_target       : true,
			target_amount    : 1500,
			collected_amount : 600,
		);

		$this->repository
			->shouldReceive( 'get_all' )
			->once()
			->andReturn( [ $dto1, $dto2 ] );

		$result = $this->service->get_all_campaigns();

		$this->assertCount( 2, $result );
		$this->assertInstanceOf( Campaign::class, $result[0] );
		$this->assertInstanceOf( Campaign::class, $result[1] );
	}
}
