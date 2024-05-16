<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;

/**
 * Represents a fixture of a valid flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagableFixture extends AbstractFlagable
{
	public const int FLAG_A = 1;

	public const int FLAG_B = 2;

	public const int FLAG_C = 4;
}
