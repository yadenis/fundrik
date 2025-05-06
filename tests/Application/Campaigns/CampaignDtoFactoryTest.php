<?php

declare(strict_types=1);

namespace Fundrik\Tests\Application\Campaigns;

use Fundrik\Application\Campaigns\CampaignDtoFactory;
use Fundrik\Domain\Campaigns\CampaignDto;
use Fundrik\Tests\FundrikTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass( CampaignDtoFactory::class )]
class CampaignDtoFactoryTest extends FundrikTestCase {

	#[Test]
	public function creates_dto_from_array() {

		$data = [
			'id'               => 123,
			'title'            => 'Array Campaign',
			'is_open'          => true,
			'has_target'       => true,
			'target_amount'    => 1500,
			'collected_amount' => 600,
		];

		$dto = ( new CampaignDtoFactory() )->from_array( $data );

		$this->assertInstanceOf( CampaignDto::class, $dto );
		$this->assertSame( 123, $dto->id );
		$this->assertSame( 'Array Campaign', $dto->title );
		$this->assertTrue( $dto->is_open );
		$this->assertTrue( $dto->has_target );
		$this->assertSame( 1500, $dto->target_amount );
		$this->assertSame( 600, $dto->collected_amount );
	}
}
