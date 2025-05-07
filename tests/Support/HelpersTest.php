<?php

declare(strict_types=1);

namespace Fundrik\Tests\Support;

use Fundrik\Infrastructure\Internal\Container;
use Fundrik\Infrastructure\Internal\ContainerManager;
use Fundrik\Infrastructure\Platforms\PlatformInterface;
use Fundrik\Tests\FundrikTestCase;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversFunction( 'fundrik' )]
#[CoversFunction( 'fundrik_escape_html' )]
#[UsesClass( ContainerManager::class )]
final class HelpersTest extends FundrikTestCase {

	protected bool $use_isolated_container = true;

	#[Test]
	public function fundrik_returns_singleton_container() {

		$container1 = fundrik();
		$container2 = fundrik();

		$this->assertInstanceOf( Container::class, $container1 );
		$this->assertSame( $container1, $container2 );
	}

	#[Test]
	public function fundrik_escape_html_delegates_to_platform() {

		$platform_mock = $this->createMock( PlatformInterface::class );

		$platform_mock
			->expects( $this->once() )
			->method( 'escape_html' )
			->with( 'raw input' )
			->willReturn( 'escaped output' );

		fundrik()->singleton( PlatformInterface::class, fn () => $platform_mock );

		$result = fundrik_escape_html( 'raw input' );

		$this->assertSame( 'escaped output', $result );
	}
}
