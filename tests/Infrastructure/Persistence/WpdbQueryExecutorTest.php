<?php

declare(strict_types=1);

namespace Fundrik\Tests\Infrastructure\Persistence;

use Fundrik\Infrastructure\Persistence\WpdbQueryExecutor;
use Fundrik\Tests\FundrikTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use wpdb;

#[CoversClass( WpdbQueryExecutor::class )]
class WpdbQueryExecutorTest extends FundrikTestCase {

	private const TABLE = 'campaigns';

	protected function setUp(): void {

		parent::setUp();

		require_once FUNDRIK_TESTS_PATH . '/mocks/wpdb.php';
	}

	public static function id_provider(): array {

		return [
			'int_id'  => [ 123 ],
			'uuid_id' => [ '0196a2f4-a700-7606-818a-00660fa2be0c' ],
		];
	}

	#[Test]
	#[DataProvider( 'id_provider' )]
	public function returns_single_row_by_id( int|string $id ) {

		$placeholder = is_int( $id ) ? '%d' : '%s';

		$mock_db = $this->createMock( wpdb::class );

		$mock_db
			->expects( $this->once() )
			->method( 'prepare' )
			->with(
				$this->identicalTo( "SELECT * FROM %i WHERE id = {$placeholder} LIMIT 1" ),
				$this->identicalTo( self::TABLE ),
				$this->identicalTo( $id )
			)
			->willReturn( 'prepared-sql' );

		$mock_db
			->expects( $this->once() )
			->method( 'get_row' )
			->with(
				$this->identicalTo( 'prepared-sql' ),
				$this->identicalTo( ARRAY_A )
			)
			->willReturn(
				[
					'id'    => $id,
					'title' => 'My Campaign',
				]
			);

		$executor = new WpdbQueryExecutor( $mock_db );
		$result   = $executor->get_by_id( self::TABLE, $id );

		$this->assertSame(
			[
				'id'    => $id,
				'title' => 'My Campaign',
			],
			$result
		);
	}


	#[Test]
	public function returns_null_when_row_not_found() {

		$mock_db = $this->createMock( wpdb::class );

		$mock_db
			->expects( $this->once() )
			->method( 'prepare' )
			->with(
				$this->identicalTo( 'SELECT * FROM %i WHERE id = %d LIMIT 1' ),
				$this->identicalTo( self::TABLE ),
				$this->identicalTo( 999 )
			)
			->willReturn( 'prepared-sql' );

		$mock_db
			->expects( $this->once() )
			->method( 'get_row' )
			->with(
				$this->identicalTo( 'prepared-sql' ),
				$this->identicalTo( ARRAY_A )
			)
			->willReturn( null );

		$executor = new WpdbQueryExecutor( $mock_db );
		$result   = $executor->get_by_id( self::TABLE, 999 );

		$this->assertNull( $result );
	}

	#[Test]
	public function returns_all_rows_from_table() {

		$mock_db = $this->createMock( wpdb::class );

		$mock_db
			->expects( $this->once() )
			->method( 'prepare' )
			->with(
				$this->identicalTo( 'SELECT * FROM %i' ),
				$this->identicalTo( self::TABLE )
			)
			->willReturn( 'prepared-sql' );

		$mock_db
			->expects( $this->once() )
			->method( 'get_results' )
			->with(
				$this->identicalTo( 'prepared-sql' ),
				$this->identicalTo( ARRAY_A )
			)
			->willReturn(
				[
					[
						'id'    => 1,
						'title' => 'First',
					],
					[
						'id'    => 2,
						'title' => 'Second',
					],
				]
			);

		$executor = new WpdbQueryExecutor( $mock_db );
		$result   = $executor->get_all( self::TABLE );

		$this->assertCount( 2, $result );
		$this->assertSame( 'First', $result[0]['title'] );
	}
}
