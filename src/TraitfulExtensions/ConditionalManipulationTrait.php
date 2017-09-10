<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\TraitfulExtensions
{

	use CodeKandis\Phlags\FlagableInterface;

	/**
	 * Represents a traitful feature to manipulate a flagable while a passed condition is true.
	 * @package codekandis/phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	trait ConditionalManipulationTrait
	{

		/**
		 * Sets a flag.
		 * @param int|FlagableInterface $value     The flag to set.
		 * @param bool                  $condition true if the value can be set, false otherwise.
		 * @return self
		 */
		public function ifSet( $value, bool $condition ): self
		{
			if ( $condition === true )
			{
				$this->set( $value );
			}

			return $this;
		}

		/**
		 * Unsets a flag.
		 * @param int|FlagableInterface $value     The flag to unset.
		 * @param bool                  $condition true if the value can be unset, false otherwise.
		 * @return self
		 */
		public function ifUnset( $value, bool $condition ): self
		{
			if ( $condition === true )
			{
				$this->unset( $value );
			}

			return $this;
		}

		/**
		 * Switches a flag.
		 * @param int|FlagableInterface $value     The flag to switch.
		 * @param bool                  $condition true if the value can be switched, false otherwise.
		 * @return self
		 */
		public function ifSwitch( $value, bool $condition ): self
		{
			if ( $condition === true )
			{
				$this->switch( $value );
			}

			return $this;
		}
	}
}
