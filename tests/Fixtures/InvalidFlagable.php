<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;

/**
 * Represents an invalid test fixture of a flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagable extends AbstractFlagable
{
	public const FLAG_A = 1;

	public const FLAG_B = 2;

	public const FLAG_C = 2;

	public const FLAG_D = 5;

	public const FLAG_E = 8;

	public const FLAG_F = 32;

	public const FLAG_G = -42;
}
