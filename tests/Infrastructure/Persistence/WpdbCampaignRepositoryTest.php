<?php

declare(strict_types=1);

namespace Fundrik\Tests\Infrastructure\Persistence;

use Fundrik\Application\Campaigns\CampaignDtoFactory;
use Fundrik\Domain\Campaigns\CampaignDto;
use Fundrik\Domain\Campaigns\CampaignId;
use Fundrik\Domain\Campaigns\Interfaces\QueryExecutorInterface;
use Fundrik\Infrastructure\Persistence\WpdbCampaignRepository;
use Fundrik\Tests\FundrikTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\MockObject;

#[CoversClass( WpdbCampaignRepository::class )]
#[UsesClass( CampaignDtoFactory::class )]
#[UsesClass( CampaignId::class )]
class WpdbCampaignRepositoryTest extends FundrikTestCase {

	private QueryExecutorInterface&MockObject $query_executor;

	private WpdbCampaignRepository $repository;

	protected function setUp(): void {

		parent::setUp();

		$this->query_executor = $this->createMock( QueryExecutorInterface::class );

		$this->repository = new WpdbCampaignRepository(
			new CampaignDtoFactory(),
			$this->query_executor
		);
	}

	#[Test]
	public function get_by_id_returns_campaign_dto_when_found() {

		$id = 123;

		$campaign_id = CampaignId::from_int( $id );

		$db_data = [
			'id'               => $id,
			'title'            => 'Test Campaign',
			'is_open'          => true,
			'has_target'       => true,
			'target_amount'    => 1000,
			'collected_amount' => 200,
		];

		$this->query_executor
			->expects( $this->once() )
			->method( 'get_by_id' )
			->with(
				$this->identicalTo( 'fundrik_campaigns' ),
				$this->identicalTo( $id )
			)
			->willReturn( $db_data );

		$result = $this->repository->get_by_id( $campaign_id );

		$this->assertInstanceOf( CampaignDto::class, $result );
		$this->assertSame( $id, $result->id );
		$this->assertSame( 'Test Campaign', $result->title );
		$this->assertSame( true, $result->is_open );
		$this->assertSame( true, $result->has_target );
		$this->assertSame( 1000, $result->target_amount );
		$this->assertSame( 200, $result->collected_amount );
	}

	#[Test]
	public function get_by_id_returns_null_when_not_found() {

		$id = 123;

		$campaign_id = CampaignId::from_int( $id );

		$this->query_executor
			->expects( $this->once() )
			->method( 'get_by_id' )
			->with(
				$this->identicalTo( 'fundrik_campaigns' ),
				$this->identicalTo( $id )
			)
			->willReturn( null );

		$result = $this->repository->get_by_id( $campaign_id );

		$this->assertNull( $result );
	}

	#[Test]
	public function get_all_returns_array_of_campaigns() {

		$db_data = [
			[
				'id'               => 123,
				'title'            => 'Campaign 1',
				'is_open'          => true,
				'has_target'       => true,
				'target_amount'    => 1000,
				'collected_amount' => 200,
			],
			[
				'id'               => 124,
				'title'            => 'Campaign 2',
				'is_open'          => false,
				'has_target'       => false,
				'target_amount'    => 0,
				'collected_amount' => 0,
			],
		];

		$this->query_executor
			->expects( $this->once() )
			->method( 'get_all' )
			->with( $this->identicalTo( 'fundrik_campaigns' ) )
			->willReturn( $db_data );

		$result = $this->repository->get_all();

		$this->assertCount( 2, $result );

		$this->assertInstanceOf( CampaignDto::class, $result[0] );
		$this->assertSame( 123, $result[0]->id );

		$this->assertInstanceOf( CampaignDto::class, $result[1] );
		$this->assertSame( 124, $result[1]->id );
	}
}
