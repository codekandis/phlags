<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests;

use function dirname;
use function error_reporting;
use function ini_set;
use function sprintf;
use const E_ALL;

/**
 * Represents the bootstrap script of the tests.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
error_reporting( E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'html_errors', 'Off' );

require_once sprintf(
	'%s/%s',
	dirname( __DIR__, 1 ),
	'vendor/autoload.php'
);
