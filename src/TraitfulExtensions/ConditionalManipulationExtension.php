<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;

/**
 * Represents a traitful extension to manipulate a flagable while a passed condition is true.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
trait ConditionalManipulationExtension
{
	/**
	 * @see ConditionalManipulationInterface::ifSet()
	 */
	public function ifSet( int|string|FlagableInterface $value, bool $condition ): static
	{
		if ( true === $condition )
		{
			$this->set( $value );
		}

		return $this;
	}

	/**
	 * @see ConditionalManipulationInterface::ifUnset()
	 */
	public function ifUnset( int|string|FlagableInterface $value, bool $condition ): static
	{
		if ( true === $condition )
		{
			$this->unset( $value );
		}

		return $this;
	}

	/**
	 * @see ConditionalManipulationInterface::ifSwitch()
	 */
	public function ifSwitch( int|string|FlagableInterface $value, bool $condition ): static
	{
		if ( true === $condition )
		{
			$this->switch( $value );
		}

		return $this;
	}
}
