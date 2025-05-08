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
			'is_open'          => true,
			'has_target'       => true,
			'target_amount'    => 1500,
			'collected_amount' => 600,
		];

		$dto = ( new CampaignDtoFactory() )->from_array( $data );

		$this->assertInstanceOf( CampaignDto::class, $dto );
		$this->assertSame( 123, $dto->id );
		$this->assertSame( 'Array Campaign', $dto->title );
		$this->assertSame( 'array-campaign', $dto->slug );
		$this->assertTrue( $dto->is_open );
		$this->assertTrue( $dto->has_target );
		$this->assertSame( 1500, $dto->target_amount );
		$this->assertSame( 600, $dto->collected_amount );
	}
}
