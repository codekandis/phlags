<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use IteratorAggregate;

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
	public function __invoke(): int;

	/**
	 * Gets the current value of the flagable.
	 * @return int The current value of the flagable
	 */
	public function getValue(): int;

	/**
	 * Determines if a value has been set.
	 * @param int|string|FlagableInterface $value The value to check if it has been set.
	 * @return bool true if the value has been set, false otherwise.
	 */
	public function has( $value ): bool;

	/**
	 * Sets a flag.
	 * @param int|string|FlagableInterface $value The flag to set.
	 * @return self
	 */
	public function set( $value ): self;

	/**
	 * Unsets a flag.
	 * @param int|string|FlagableInterface $value The flag to unset.
	 * @return self
	 */
	public function unset( $value ): self;

	/**
	 * Switches a flag.
	 * @param int|string|FlagableInterface $value The flag to switch.
	 * @return self
	 */
	public function switch( $value ): self;

	/**
	 * {@inheritdoc}
	 * Generates a list of all flags set in the flagable, each as a new flagable.
	 * @return iterable|FlagableInterface[] The list of all flags set in the flagable, each as a new flagable.
	 */
	public function getIterator(): iterable;
}
