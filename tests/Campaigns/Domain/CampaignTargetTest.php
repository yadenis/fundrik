<?php

declare(strict_types=1);

namespace Fundrik\Tests\Campaigns\Domain;

use Fundrik\Campaigns\Domain\CampaignTarget;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass( 'Fundrik\Campaigns\Domain\CampaignTarget' )]
class CampaignTargetTest extends TestCase {

	#[Test]
	public function creates_when_enabled_target_with_amount() {

		$target = new CampaignTarget( true, 1000 );

		$this->assertEquals( '1000', (string) $target );
	}

	#[Test]
	public function throws_when_target_enabled_but_zero_amount() {

		$this->expectException( InvalidArgumentException::class );

		new CampaignTarget( true, 0 );
	}

	#[Test]
	public function throws_when_target_enabled_but_negative_amount() {

		$this->expectException( InvalidArgumentException::class );

		new CampaignTarget( true, -500 );
	}

	#[Test]
	public function creates_when_disabled_target_with_zero_amount() {

		$target = new CampaignTarget( false, 0 );

		$this->assertEquals( '0', (string) $target );
	}

	#[Test]
	public function throws_when_target_disabled_but_positive_amount() {

		$this->expectException( InvalidArgumentException::class );

		new CampaignTarget( false, 100 );
	}

	#[Test]
	public function throws_when_target_disabled_but_negative_amount() {

		$this->expectException( InvalidArgumentException::class );

		new CampaignTarget( false, -500 );
	}
}
