<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;

/**
 * Represents a fixture of an invalid flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableFixture extends AbstractFlagable
{
	public const int FLAG_A = 1;

	public const int FLAG_B = 2;

	public const int FLAG_C = 2;

	public const int FLAG_D = 5;

	public const int FLAG_E = 8;

	public const int FLAG_F = 32;

	public const int FLAG_G = -42;
}
