<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

/**
 * Represents the interface of any validator.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ValidatorInterface
{
	/**
	 * Gets the error messages of the validation.
	 * @return string[] The error messages of the validation.
	 */
	public function getErrorMessages(): array;

	/**
	 * Determines if the validation has been succeeded.
	 * @return bool True if the validation has been succeeded, otherwise false.
	 */
	public function succeeded(): bool;
}
