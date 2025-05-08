<?php

declare(strict_types=1);

namespace Fundrik\Core\Tests\Support;

use Fundrik\Core\Infrastructure\Internal\Container;
use Fundrik\Core\Infrastructure\Internal\ContainerManager;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversFunction( 'fundrik' )]
#[UsesClass( ContainerManager::class )]
final class HelpersTest extends TestCase {

	#[Test]
	public function fundrik_returns_singleton_container() {

		$container1 = fundrik();
		$container2 = fundrik();

		$this->assertInstanceOf( Container::class, $container1 );
		$this->assertSame( $container1, $container2 );
	}
}
