<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\Validation\Results\FlagableValidationResultInterface;

/**
 * Represents the interface of all validators validating flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableValidatorInterface
{
	/**
	 * Validates the flagable.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable to validate.
	 * @return FlagableValidationResultInterface The result of the flagable validation.
	 */
	public function validate( string $flagableClassName, array $reflectedFlags ): FlagableValidationResultInterface;
}
