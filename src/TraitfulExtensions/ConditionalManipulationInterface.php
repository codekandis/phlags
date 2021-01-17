<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;

interface ConditionalManipulationInterface
{
	/**
	 * Sets a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to set.
	 * @param bool $condition The condition defining if the flag can be set.
	 * @return self The flagable.
	 */
	public function ifSet( $value, bool $condition ): ConditionalManipulationInterface;

	/**
	 * Unsets a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to unset.
	 * @param bool $condition The condition defining if the flag can be unset.
	 * @return self The flagable.
	 */
	public function ifUnset( $value, bool $condition ): ConditionalManipulationInterface;

	/**
	 * Switches a flag if the passed condition is true.
	 * @param int|string|FlagableInterface $value The flag to switch.
	 * @param bool $condition The condition defining if the flag can be switched.
	 * @return self The flagable.
	 */
	public function ifSwitch( $value, bool $condition ): ConditionalManipulationInterface;
}
