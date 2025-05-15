<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Domain\Campaigns;

use Fundrik\Core\Domain\EntityId;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass( EntityId::class )]
class CampaignIdTest extends TestCase {

	#[Test]
	public function creates_from_positive_int() {

		$campaign_id = EntityId::create( 123 );

		$this->assertEquals( '123', (string) $campaign_id );
	}

	#[Test]
	public function throws_when_negative_int_provided() {

		$this->expectException( InvalidArgumentException::class );

		EntityId::create( -123 );
	}

	#[Test]
	public function throws_when_zero_provided() {

		$this->expectException( InvalidArgumentException::class );

		EntityId::create( 0 );
	}

	#[Test]
	public function creates_from_valid_uuid() {

		$uuid        = '0196930b-f2ef-7ec8-b685-cffc19cbf0e3';
		$campaign_id = EntityId::create( $uuid );

		$this->assertEquals( $uuid, (string) $campaign_id );
	}

	#[Test]
	public function throws_when_invalid_uuid_provided() {

		$this->expectException( InvalidArgumentException::class );

		EntityId::create( 'invalid-uuid' );
	}

	#[Test]
	public function checks_uuid_case_normalization() {

		$uuid        = '0196A27F-1441-7692-AAEF-92889618FC12';
		$campaign_id = EntityId::create( $uuid );

		$this->assertEquals(
			'0196a27f-1441-7692-aaef-92889618fc12',
			(string) $campaign_id
		);
	}
}
