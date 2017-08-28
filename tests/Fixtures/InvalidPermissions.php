<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Fixtures
{

	use CodeKandis\Phlags\AbstractFlagable;

	/**
	 * Represents an invalid test fixture of an flagable.
	 * @package codekandis\phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	class InvalidPermissions extends AbstractFlagable
	{
		public const DIRECTORY = 1;

		public const UREAD_1   = 2;

		public const UREAD_2   = 2;

		public const UWRITE    = 4;

		public const UEXECUTE  = 5;
	}
}
