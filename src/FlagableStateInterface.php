<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;

/**
 * Represents the interface of any flagable state.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableStateInterface
{
	/**
	 * Gets if the flagable has been validated.
	 * @return bool True if the flagable has been validated, otherwise false.
	 */
	public function getHasBeenValidated(): bool;

	/**
	 * Sets if the flagable has been validated.
	 * @param bool $hasBeenValidated True if the flagable has been validated, otherwise false.
	 */
	public function setHasBeenValidated( bool $hasBeenValidated ): void;

	/**
	 * Gets the thrown exception of the validation of the flagable.
	 * @return ?InvalidFlagableExceptionInterface The thrown exception of the validation of the flagable.
	 */
	public function getValidationException(): ?InvalidFlagableExceptionInterface;

	/**
	 * Sets the thrown exception of the validation of the flagable.
	 * @param ?InvalidFlagableExceptionInterface $validationException The thrown exception of the validation of the flagable.
	 */
	public function setValidationException( ?InvalidFlagableExceptionInterface $validationException ): void;

	/**
	 * Gets the reflected flags of the flagable.
	 * @return ?string[] The reflected flags of the flagable.
	 */
	public function getReflectedFlags(): ?array;

	/**
	 * Sets the reflected flags of the flagable.
	 * @param ?string[] $reflectedFlags The reflected flags of the flagable.
	 */
	public function setReflectedFlags( ?array $reflectedFlags ): void;

	/**
	 * Gets the maximum flag value of the flagable.
	 * @return ?int The reflected flags of the flagable.
	 */
	public function getMaximumValue(): ?int;

	/**
	 * Sets the maximum flag value of the flagable.
	 * @param ?int $maximumValue The reflected flags of the flagable.
	 */
	public function setMaximumValue( ?int $maximumValue ): void;

	/**
	 * Gets the value validator of the flagable.
	 * @return ?ValueValidatorInterface The reflected flags of the flagable.
	 */
	public function getValueValidator(): ?ValueValidatorInterface;

	/**
	 * Sets the value validator of the flagable.
	 * @param ?ValueValidatorInterface $valueValidator The reflected flags of the flagable.
	 */
	public function setValueValidator( ?ValueValidatorInterface $valueValidator ): void;
}
