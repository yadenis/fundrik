<?php

declare(strict_types=1);

namespace Fundrik\Tests\Domain\Campaigns;

use Fundrik\Infrastructure\Platforms\WordpressPlatform;
use Fundrik\Tests\FundrikTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

#[CoversClass( WordpressPlatform::class )]
class WordpressPlatformTest extends FundrikTestCase {

	#[Test]
	public function escape_html_delegates_to_esc_html(): void {

		require_once FUNDRIK_TESTS_PATH . '/mocks/esc_html.php';

		$platform = new WordpressPlatform();

		$output = $platform->escape_html( 'A "quick" brown fox jumps over the lazy <b>dog</b>!' );

		$this->assertSame(
			'The funny white rabbit escaped this string and here is: A "quick" brown fox jumps over the lazy <b>dog</b>!',
			$output
		);
	}
}
