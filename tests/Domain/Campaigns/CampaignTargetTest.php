<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Domain\Campaigns;

use Fundrik\Core\Domain\Campaigns\CampaignTarget;
use Fundrik\Core\Tests\FundrikTestCase;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass( CampaignTarget::class )]
class CampaignTargetTest extends FundrikTestCase {

	#[Test]
	public function creates_when_enabled_target_with_amount() {

		$target = new CampaignTarget( true, 1000 );

		$this->assertSame( '1000', (string) $target );
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

		$this->assertSame( '0', (string) $target );
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
