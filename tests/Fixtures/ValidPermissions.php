<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Fixtures
{

	use CodeKandis\Phlags\AbstractFlagable;

	/**
	 * Represents a test fixture of a flagable.
	 * @package codekandis/phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	class ValidPermissions extends AbstractFlagable
	{
		public const DIRECTORY = 1;

		public const UREAD     = 2;

		public const UWRITE    = 4;
	}
}
