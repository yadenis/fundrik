<?php

declare(strict_types=1);

use Fundrik\Core\Infrastructure\Internal\Container;
use Fundrik\Core\Infrastructure\Internal\ContainerManager;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass( ContainerManager::class )]
final class ContainerManagerTest extends TestCase {

	protected function setUp(): void {

		$reflection = new ReflectionClass( ContainerManager::class );
		$property   = $reflection->getProperty( 'container' );
		$property->setAccessible( true );
		$property->setValue( null );
	}

	#[Test]
	public function returns_container_instance() {

		$container = ContainerManager::get();

		$this->assertInstanceOf( Container::class, $container );
	}

	#[Test]
	public function returns_same_container_instance() {

		$first  = ContainerManager::get();
		$second = ContainerManager::get();

		$this->assertSame( $first, $second );
	}

	#[Test]
	public function overrides_container() {

		$container = new Container();

		ContainerManager::set( $container );

		$this->assertSame( $container, ContainerManager::get() );
	}
}
