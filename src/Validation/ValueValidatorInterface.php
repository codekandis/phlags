<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\FlagableInterface;

/**
 * Represents the interface of any validator validating if a value is a valid flag.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ValueValidatorInterface extends ValidatorInterface
{
	/**
	 * Validates the value.
	 * @param FlagableInterface $flagable The flagable the value has to be validated against.
	 * @param <string,int>[] $reflectedFlags The reflected flags of the flagable.
	 * @param int $maximumValue The maximum flag value of the flagable.
	 * @param mixed $value The value to validate.
	 */
	public function validate( FlagableInterface $flagable, array $reflectedFlags, int $maximumValue, mixed $value ): void;
}
