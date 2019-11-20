<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;

/**
 * Represents a test fixture of a flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagable extends AbstractFlagable
{
	public const FLAG_A = 1;

	public const FLAG_B = 2;

	public const FLAG_C = 4;
}
