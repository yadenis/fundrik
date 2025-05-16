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

		$this->reset_container();
	}

	protected function tearDown(): void {

		$this->reset_container();
	}

	#[Test]
	public function returns_container_instance(): void {

		$container = ContainerManager::get();

		$this->assertInstanceOf( Container::class, $container );
	}

	#[Test]
	public function returns_same_container_instance_on_multiple_calls(): void {

		$first  = ContainerManager::get();
		$second = ContainerManager::get();

		$this->assertEquals( $first, $second );
	}

	#[Test]
	public function overrides_container(): void {

		$container = new Container();

		ContainerManager::set( $container );

		$this->assertEquals( $container, ContainerManager::get() );
	}

	#[Test]
	public function reset_clears_the_container(): void {

		$original = ContainerManager::get();

		ContainerManager::reset();

		$new_instance = ContainerManager::get();

		$this->assertNotSame( $original, $new_instance );
	}

	#[Test]
	public function get_fresh_replaces_and_returns_new_container(): void {

		$first = ContainerManager::get();

		$fresh = ContainerManager::get_fresh();

		$this->assertInstanceOf( Container::class, $fresh );
		$this->assertNotSame( $first, $fresh );

		$this->assertSame( $fresh, ContainerManager::get() );
	}

	private function reset_container(): void {

		$reflection = new ReflectionClass( ContainerManager::class );
		$property   = $reflection->getProperty( 'container' );
		$property->setAccessible( true );
		$property->setValue( null );
	}
}
