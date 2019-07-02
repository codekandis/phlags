<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;

/**
 * Represents an invalid test fixture of a flagable.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
class InvalidPermissions extends AbstractFlagable
{
	public const DIRECTORY = 1;

	public const UREAD_1   = 2;

	public const UREAD_2   = 2;

	public const UEXECUTE  = 5;

	public const GREAD     = 8;

	public const GEXECUTE  = 32;
}
