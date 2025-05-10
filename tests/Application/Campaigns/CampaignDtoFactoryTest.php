<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Application\Campaigns;

use Fundrik\Core\Application\Campaigns\CampaignDtoFactory;
use Fundrik\Core\Domain\Campaigns\CampaignDto;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass( CampaignDtoFactory::class )]
class CampaignDtoFactoryTest extends TestCase {

	#[Test]
	public function creates_dto_from_array() {

		$data = [
			'id'               => 123,
			'title'            => 'Array Campaign',
			'slug'             => 'array-campaign',
			'is_enabled'       => true,
			'is_open'          => true,
			'has_target'       => true,
			'target_amount'    => 1500,
			'collected_amount' => 600,
		];

		$dto = ( new CampaignDtoFactory() )->from_array( $data );

		$this->assertInstanceOf( CampaignDto::class, $dto );
		$this->assertEquals( 123, $dto->id );
		$this->assertEquals( 'Array Campaign', $dto->title );
		$this->assertEquals( 'array-campaign', $dto->slug );
		$this->assertTrue( $dto->is_enabled );
		$this->assertTrue( $dto->is_open );
		$this->assertTrue( $dto->has_target );
		$this->assertEquals( 1500, $dto->target_amount );
		$this->assertEquals( 600, $dto->collected_amount );
	}
}
