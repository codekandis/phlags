<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;

interface ConditionalManipulationInterface
{
	/**
	 * Sets a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to set.
	 * @param bool $condition The condition defining if the flag can be set.
	 * @return self The flagable.
	 * @throws InvalidValueExceptionInterface The flag to set is invalid.
	 */
	public function ifSet( int|string|FlagableInterface $value, bool $condition ): static;

	/**
	 * Unsets a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to unset.
	 * @param bool $condition The condition defining if the flag can be unset.
	 * @return self The flagable.
	 * @throws InvalidValueExceptionInterface The flag to unset is invalid.
	 */
	public function ifUnset( int|string|FlagableInterface $value, bool $condition ): static;

	/**
	 * Switches a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to switch.
	 * @param bool $condition The condition defining if the flag can be switched.
	 * @return self The flagable.
	 * @throws InvalidValueExceptionInterface The flag to switch is invalid.
	 */
	public function ifSwitch( int|string|FlagableInterface $value, bool $condition ): static;
}
