<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation\Results
{

	/**
	 * Represents the interface of all flagable validation results.
	 * @package codekandis/phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	interface FlagableValidationResultInterface extends ValidationResultInterface
	{
		/**
		 * Gets the maximum value of the validated flagable.
		 * @return int The maximum value of the validated flagable.
		 */
		public function getMaxValue(): int;
	}
}
