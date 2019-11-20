<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

/**
 * Represents the interface of all validators validating flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableValidatorInterface extends ValidatorInterface
{
	/**
	 * Gets the maximum flag value of the validated flagable.
	 * @return int The maximum flag value of the validated flagable.
	 */
	public function getMaxValue(): int;

	/**
	 * Validates the flagable.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable to validate.
	 */
	public function validate( string $flagableClassName, array $reflectedFlags ): void;
}
