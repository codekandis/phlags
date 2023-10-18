<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidValueException;
use IteratorAggregate;
use Traversable;

/**
 * Represents the interface of all flagable classes.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableInterface extends IteratorAggregate
{
	/**
	 * Stores the default flag.
	 * @var int
	 */
	public const NONE = 0;

	/**
	 * Gets the string representation of the current value.
	 * @return string The string representation of the current value.
	 */
	public function __toString(): string;

	/**
	 * Gets the current value of the flagable.
	 * @return int The current value of the flagable.
	 */
	public function __invoke();

	/**
	 * Gets the current value of the flagable.
	 * @return int The current value of the flagable
	 */
	public function getValue(): int;

	/**
	 * Determines if a value has been set.
	 * @param int|string|FlagableInterface $value The value to check if it has been set.
	 * @return bool True if the value has been set, false otherwise.
	 * @throws InvalidValueException The flag to check is invalid.
	 */
	public function has( $value ): bool;

	/**
	 * Sets a flag.
	 * @param int|string|FlagableInterface $value The flag to set.
	 * @return self The flagable.
	 * @throws InvalidValueException The flag to set is invalid.
	 */
	public function set( $value ): static;

	/**
	 * Unsets a flag.
	 * @param int|string|FlagableInterface $value The flag to unset.
	 * @return self The flagable.
	 * @throws InvalidValueException The flag to unset is invalid.
	 */
	public function unset( $value ): static;

	/**
	 * Switches a flag.
	 * @param int|string|FlagableInterface $value The flag to switch.
	 * @return self The flagable.
	 * @throws InvalidValueException The flag to switch is invalid.
	 */
	public function switch( $value ): static;

	/**
	 * {@inheritdoc}
	 * Generates a list of all flags set in the flagable, each as a new flagable.
	 * @return iterable|FlagableInterface[] The list of all flags set in the flagable, each as a new flagable.
	 */
	public function getIterator(): Traversable;
}
