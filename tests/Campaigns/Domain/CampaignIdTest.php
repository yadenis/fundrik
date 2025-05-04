<?php

declare(strict_types=1);

namespace Fundrik\Tests\Campaigns\Domain;

use Fundrik\Campaigns\Domain\CampaignId;
use Fundrik\Tests\FundrikTestCase;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass( 'Fundrik\Campaigns\Domain\CampaignId' )]
class CampaignIdTest extends FundrikTestCase {

	#[Test]
	public function creates_from_positive_int() {

		$id = CampaignId::create( 123 );

		$this->assertEquals( '123', (string) $id );
	}

	#[Test]
	public function throws_when_negative_int_provided() {

		$this->expectException( InvalidArgumentException::class );

		CampaignId::create( -123 );
	}

	#[Test]
	public function throws_when_zero_provided() {

		$this->expectException( InvalidArgumentException::class );

		CampaignId::create( 0 );
	}

	#[Test]
	public function creates_from_valid_uuid() {

		$uuid = '0196930b-f2ef-7ec8-b685-cffc19cbf0e3';
		$id   = CampaignId::create( $uuid );

		$this->assertEquals( $uuid, (string) $id );
	}

	#[Test]
	public function throws_when_invalid_uuid_provided() {

		$this->expectException( InvalidArgumentException::class );

		CampaignId::create( 'invalid-uuid' );
	}
}
