<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;

/**
 * Represents the interface of all flagable states.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableStateInterface
{
	/**
	 * Gets if the flagable has been validated.
	 * @return bool true if the flagable has been validated, false otherwise.
	 */
	public function getHasBeenValidated(): bool;

	/**
	 * Sets if the flagable has been validated.
	 * @param bool $hasBeenValidated true if the flagable has been validated, false otherwise.
	 */
	public function setHasBeenValidated( bool $hasBeenValidated ): void;

	/**
	 * Gets the thrown exception of the validation of the flagable.
	 * @return null|InvalidFlagableException The thrown exception of the validation of the flagable.
	 */
	public function getValidationException(): ?InvalidFlagableException;

	/**
	 * Sets the thrown exception of the validation of the flagable.
	 * @param null|InvalidFlagableException $flagableException The thrown exception of the validation of the flagable.
	 */
	public function setValidationException( ?InvalidFlagableException $flagableException ): void;

	/**
	 * Gets the reflected flags of the flagable.
	 * @return null|string[] The reflected flags of the flagable.
	 */
	public function getReflectedFlags(): ?array;

	/**
	 * Sets the reflected flags of the flagable.
	 * @param null|string[] $reflectedFlags The reflected flags of the flagable.
	 */
	public function setReflectedFlags( ?array $reflectedFlags ): void;

	/**
	 * Gets the maximum value of the flagable.
	 * @return null|int The reflected flags of the flagable.
	 */
	public function getMaxValue(): ?int;

	/**
	 * Sets the maximum value of the flagable.
	 * @param null|int $maxValue The reflected flags of the flagable.
	 */
	public function setMaxValue( ?int $maxValue ): void;

	/**
	 * Gets the value validator of the flagable.
	 * @return null|ValueValidatorInterface The reflected flags of the flagable.
	 */
	public function getValueValidator(): ?ValueValidatorInterface;

	/**
	 * Sets the value validator of the flagable.
	 * @param null|ValueValidatorInterface $valueValidator The reflected flags of the flagable.
	 */
	public function setValueValidator( ?ValueValidatorInterface $valueValidator ): void;
}
