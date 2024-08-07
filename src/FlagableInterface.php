<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\Types\MethodNotFoundExceptionInterface;
use CodeKandis\Types\PropertyNotFoundExceptionInterface;
use IteratorAggregate;
use Traversable;

/**
 * Represents the interface of any flagable class.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface FlagableInterface extends IteratorAggregate
{
	/**
	 * Stores the default flag.
	 */
	public const int NONE = 0;

	/**
	 * Unsets an undefined member.
	 * @param string $memberName The name of the undefined member.
	 * @throws PropertyNotFoundExceptionInterface The access of an undefined member is not supported.
	 */
	public function __unset( string $memberName ): void;

	/**
	 * Gets an undefined member.
	 * @param string $memberName The name of the undefined member.
	 * @return mixed The value of the undefined member.
	 * @throws PropertyNotFoundExceptionInterface The access of an undefined member is not supported.
	 */
	public function __get( string $memberName ): mixed;

	/**
	 * Sets an undefined member.
	 * @param string $memberName The name of the undefined member.
	 * @param mixed $value The value to set.
	 * @throws PropertyNotFoundExceptionInterface The access of an undefined member is not supported.
	 */
	public function __set( string $memberName, mixed $value ): void;

	/**
	 * Calls an undefined method.
	 * @param string $methodName The name of the undefined method.
	 * @param array $arguments The passed arguments.
	 * @return mixed The return value of the undefined method.
	 * @throws MethodNotFoundExceptionInterface The access of an undefined method is not supported.
	 */
	public function __call( string $methodName, array $arguments ): mixed;

	/**
	 * Calls an undefined static method.
	 * @param string $methodName The name of the undefined static method.
	 * @param array $arguments The passed arguments.
	 * @return mixed The return value of the undefined static method.
	 * @throws MethodNotFoundExceptionInterface The access of an undefined static method is not supported.
	 */
	public static function __callStatic( string $methodName, array $arguments ): mixed;

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
	 * @return bool True if the value has been set, otherwise false.
	 * @throws InvalidValueExceptionInterface The flag to check is invalid.
	 */
	public function has( int|string|FlagableInterface $value ): bool;

	/**
	 * Sets a flag.
	 * @param int|string|FlagableInterface $value The flag to set.
	 * @return static
	 * @throws InvalidValueExceptionInterface The flag to set is invalid.
	 */
	public function set( int|string|FlagableInterface $value ): static;

	/**
	 * Unsets a flag.
	 * @param int|string|FlagableInterface $value The flag to unset.
	 * @return static
	 * @throws InvalidValueExceptionInterface The flag to unset is invalid.
	 */
	public function unset( int|string|FlagableInterface $value ): static;

	/**
	 * Switches a flag.
	 * @param int|string|FlagableInterface $value The flag to switch.
	 * @return static
	 * @throws InvalidValueExceptionInterface The flag to switch is invalid.
	 */
	public function switch( int|string|FlagableInterface $value ): static;

	/**
	 * @inheritDoc
	 * Generates a list of all flags set in the flagable, each as a new flagable.
	 * @return iterable|FlagableInterface[] The list of all flags set in the flagable, each as a new flagable.
	 */
	public function getIterator(): Traversable;
}
