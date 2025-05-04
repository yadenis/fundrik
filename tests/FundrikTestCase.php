<?php

declare(strict_types=1);

namespace Fundrik\Tests;

use Fundrik\Infrastructure\Internal\Container;
use Fundrik\Infrastructure\Internal\ContainerManager;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

abstract class FundrikTestCase extends PHPUnitTestCase {

	protected bool $use_isolated_container = false;

	private Container $original_container;

	protected function setUp(): void {

		parent::setUp();

		if ( $this->use_isolated_container ) {

			$this->original_container = fundrik();
			ContainerManager::set(new Container());
		}
	}

	protected function tearDown(): void {

		if ( $this->use_isolated_container ) {
			
			ContainerManager::set($this->original_container);
		}

		parent::tearDown();
	}
}