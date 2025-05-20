<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Application\Campaigns;

use Fundrik\Core\Application\Campaigns\CampaignDto;
use Fundrik\Core\Application\Campaigns\CampaignDtoFactory;
use Fundrik\Core\Domain\Campaigns\Campaign;
use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use Fundrik\Core\Domain\EntityId;
use Fundrik\Core\Infrastructure\Internal\ContainerManager;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\UsesFunction;
use PHPUnit\Framework\TestCase;

#[CoversClass( CampaignDtoFactory::class )]
#[UsesClass( Campaign::class )]
#[UsesClass( CampaignTarget::class )]
#[UsesClass( EntityId::class )]
#[UsesClass( ContainerManager::class )]
#[UsesFunction( 'fundrik' )]
class CampaignDtoFactoryTest extends TestCase {

	private CampaignDtoFactory $dto_factory;

	protected function setUp(): void {

		$this->dto_factory = new CampaignDtoFactory();
	}

	#[Test]
	public function creates_dto_from_array(): void {

		$data = [
			'id'            => 123,
			'title'         => 'Array Campaign',
			'is_enabled'    => true,
			'is_open'       => true,
			'has_target'    => true,
			'target_amount' => 1500,
		];

		$dto = $this->dto_factory->from_array( $data );

		$this->assertInstanceOf( CampaignDto::class, $dto );
		$this->assertEquals( 123, $dto->id );
		$this->assertEquals( 'Array Campaign', $dto->title );
		$this->assertTrue( $dto->is_enabled );
		$this->assertTrue( $dto->is_open );
		$this->assertTrue( $dto->has_target );
		$this->assertEquals( 1500, $dto->target_amount );
	}

	#[Test]
	public function creates_dto_from_campaign(): void {

		$campaign = new Campaign(
			id: EntityId::create( 456 ),
			title: 'Domain Campaign',
			is_enabled: false,
			is_open: true,
			target: new CampaignTarget( is_enabled: false, amount: 0 ),
		);

		$dto = $this->dto_factory->from_campaign( $campaign );

		$this->assertInstanceOf( CampaignDto::class, $dto );
		$this->assertEquals( 456, $dto->id );
		$this->assertEquals( 'Domain Campaign', $dto->title );
		$this->assertFalse( $dto->is_enabled );
		$this->assertTrue( $dto->is_open );
		$this->assertFalse( $dto->has_target );
		$this->assertEquals( 0, $dto->target_amount );
	}
}
