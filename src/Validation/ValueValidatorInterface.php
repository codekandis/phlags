<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Validation\Results\ValidationResultInterface;

/**
 * Represents the interface of all validators validating if a value is a valid flag.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ValueValidatorInterface
{
	/**
	 * Validates the value.
	 * @param FlagableInterface $flagable The flagable the value has to be validated against.
	 * @param array $reflectedFlags The reflected flags of the flagable.
	 * @param int $maxValue The maximum value of the flagable.
	 * @param int|string|FlagableInterface $value The value to validate.
	 * @return ValidationResultInterface The result of the value validation.
	 */
	public function validate( FlagableInterface $flagable, array $reflectedFlags, int $maxValue, $value ): ValidationResultInterface;
}
