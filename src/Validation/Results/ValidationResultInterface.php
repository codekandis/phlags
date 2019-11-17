<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation\Results
{

	/**
	 * Represents interface of all validation results.
	 * @package codekandis\phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	interface ValidationResultInterface
	{
		/**
		 * Gets the error messages of the validation.
		 * @return string[] The error messages of the validation.
		 */
		public function getErrorMessages(): array;

		/**
		 * Determines if the validation has been succeeded.
		 * @return bool true if the validation has been succeeded, false otherwise.
		 */
		public function succeeded(): bool;

		/**
		 * Determines if the validation has been failed.
		 * @return bool true if the validation has been failed, false otherwise.
		 */
		public function failed(): bool;
	}
}
