<?php
/**
 * Container bindings for Fundrik plugin.
 *
 * @package Fundrik\Bootstrap
 *
 * @since 1.0.0
 */

declare(strict_types=1);

use Fundrik\Infrastructure\Platforms\PlatformInterface;
use Fundrik\Infrastructure\Platforms\WordpressPlatform;

$fundrik_container = fundrik();

$fundrik_container->singleton( PlatformInterface::class, WordpressPlatform::class );
