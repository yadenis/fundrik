<?php

declare(strict_types=1);

define( 'FUNDRIK', true );
define( 'FUNDRIK_MAIN_FILE', realpath( __DIR__ . '/../fundrik.php' ) );
define( 'FUNDRIK_PATH', realpath( dirname( FUNDRIK_MAIN_FILE ) ) );

require_once FUNDRIK_PATH . '/vendor/autoload.php';
