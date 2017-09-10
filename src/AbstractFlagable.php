<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags
{

	use CodeKandis\Phlags\Exceptions\InvalidFlagableException;
	use CodeKandis\Phlags\Exceptions\InvalidValueException;
	use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
	use CodeKandis\Phlags\Validation\FlagableValidator;
	use CodeKandis\Phlags\Validation\ValueValidator;
	use CodeKandis\Phlags\Validation\ValueValidatorInterface;

	/**
	 * Represents the base class of all flagable classes.
	 * @package codekandis/phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	abstract class AbstractFlagable implements FlagableInterface
	{
		/**
		 * Stores if the flagable has been validated.
		 * @var bool
		 */
		protected static $_hasBeenValidated = false;

		/**
		 * Stores the thrown exception of the validation of the flagable.
		 * @var InvalidFlagableException
		 */
		protected static $_validationException;

		/**
		 * Stores the reflected flags of the flagable.
		 * @var array
		 */
		protected static $_reflectedFlags;

		/**
		 * Stores the maximum value of the flagable.
		 * @var int
		 */
		protected static $_maxValue = self::NONE;

		/**
		 * Stores the value validator of the flagable.
		 * @var ValueValidatorInterface
		 */
		protected static $_valueValidator;

		/**
		 * Stores the current value of the flagable.
		 * @var int
		 */
		private $_value;

		/**
		 * Constructor method.
		 * @param int|FlagableInterface $value The initial value of the flagable.
		 * @throws InvalidFlagableException The flagable is invalid.
		 * @throws InvalidValueException The value is invalid.
		 */
		final public function __construct( $value = self::NONE )
		{
			static::initializeReflectedFlags();
			static::validateFlagable();
			self::$_valueValidator = self::$_valueValidator ?? new ValueValidator();
			$this->set( $value );
		}

		/**
		 * Determines if a undefined member has been set.
		 * @param string $memberName Gets the name of the undefined member.
		 * @return bool false while accessing undefined members is not supported.
		 */
		final public function __isset( string $memberName ): bool
		{
			return false;
		}

		/**
		 * Unsets an undefined member.
		 * @param string $memberName The name of the undefined member.
		 * @return mixed The value of the undefined member.
		 * @throws UnsupportedOperationException Accessing undefined members is not supported.
		 */
		final public function __unset( string $memberName ): void
		{
			throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
		}

		/**
		 * Gets an undefined member.
		 * @param string $memberName The name of the undefined member.
		 * @return mixed The value of the undefined member.
		 * @throws UnsupportedOperationException Accessing undefined members is not supported.
		 */
		final public function __get( string $memberName )
		{
			throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
		}

		/**
		 * Sets an undefined member.
		 * @param string $memberName The name of the undefined member.
		 * @param mixed  $value      The value to set.
		 * @return void
		 * @throws UnsupportedOperationException Accessing undefined members is not supported.
		 */
		final public function __set( string $memberName, $value ): void
		{
			throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
		}

		/**
		 * Calls an undefined method.
		 * @param string $methodName The name of the undefined method.
		 * @param array  $arguments  The passed arguments.
		 * @return mixed The return value of the undefined method.
		 * @throws UnsupportedOperationException Accessing undefined methods is not supported.
		 */
		final public function __call( string $methodName, array $arguments )
		{
			throw new UnsupportedOperationException( 'Accessing undefined methods is not supported.' );
		}

		/**
		 * Calls an undefined static method.
		 * @param string $methodName The name of the undefined static method.
		 * @param array  $arguments  The passed arguments.
		 * @return mixed The return value of the undefined static method.
		 * @throws UnsupportedOperationException Accessing undefined methods is not supported.
		 */
		final public static function __callStatic( string $methodName, array $arguments )
		{
			throw new UnsupportedOperationException( 'Accessing undefined methods is not supported.' );
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::__toString()
		 */
		final public function __toString(): string
		{
			$flagsSetNames = [];
			foreach ( static::$_reflectedFlags as $reflectedFlagName => $reflectedFlagValue )
			{
				if ( $reflectedFlagValue !== 0 && ( $this->_value & $reflectedFlagValue ) === $reflectedFlagValue )
				{
					$flagsSetNames[] = $reflectedFlagName;
				}
			}

			return (string) ( empty( $flagsSetNames ) === true
				? 'NONE'
				: implode( '|', $flagsSetNames ) );
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::__invoke()
		 */
		final public function __invoke(): int
		{
			return $this->getValue();
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::getValue()
		 */
		final public function getValue(): int
		{
			return $this->_value;
		}

		/**
		 * Initialized the reflected flags for validation and stringifying.
		 * @return void
		 */
		private static function initializeReflectedFlags(): void
		{
			try
			{
				static::$_reflectedFlags = ( new \ReflectionClass( static::class ) )->getConstants();
				asort( static::$_reflectedFlags );
			}
			catch ( \ReflectionException $exception )
			{
			}
		}

		/**
		 * Validates the flagable
		 * @return void
		 * @throws InvalidFlagableException The flagable is invalid.
		 */
		private static function validateFlagable(): void
		{
			if ( static::$_hasBeenValidated === true && static::$_validationException !== null )
			{
				throw static::$_validationException;
			}
			static::$_hasBeenValidated = true;
			$validationResult          = ( new FlagableValidator )->validate( static::class, static::$_reflectedFlags );
			if ( $validationResult->failed() === true )
			{
				throw ( new InvalidFlagableException( 'Invalid flagable.' ) )->withErrorMessages( $validationResult->getErrorMessages() );
			}
			static::$_maxValue = $validationResult->getMaxValue();
		}

		/**
		 * Validates a value.
		 * @param int|FlagableInterface $value The value to validate.
		 * @return void
		 * @throws InvalidValueException The value is invalid.
		 */
		private function validateValue( $value ): void
		{
			$validationResult = self::$_valueValidator->validate( $this, static::$_reflectedFlags, self::$_maxValue, $value );
			if ( $validationResult->failed() === true )
			{
				throw ( new InvalidValueException( 'Invalid value.' ) )->withErrorMessages( $validationResult->getErrorMessages() );
			}
		}

		/**
		 * Gets the extracted value of a value.
		 * @param mixed $value The value to transform.
		 * @return int The transformed value.
		 */
		private function getExtractedValue( $value ): int
		{
			if ( is_int( $value ) === true )
			{
				return $value;
			}
			if ( is_string( $value ) === true )
			{
				$extractedValue = FlagableInterface::NONE;
				$explodedValues = explode( '|', $value );
				foreach ( $explodedValues as $explodedValue )
				{
					if ( ctype_digit( $explodedValue ) === false )
					{
						$extractedValue |= static::$_reflectedFlags[ $explodedValue ];
						continue;
					}
					$extractedValue |= (int) $explodedValue;
				}

				return $extractedValue;
			}

			return $value->getValue();
		}

		/**
		 * Determines if a value has been set.
		 * @param int $value The value to check if it has been set.
		 * @return bool true if the value has been set, false otherwise.
		 */
		private function unvalidatedHas( int $value ): bool
		{
			return ( $this->_value & $value ) === $value;
		}

		/**
		 * Sets a flag.
		 * @param int $value The flag to set.
		 * @return void
		 */
		private function unvalidatedSet( int $value ): void
		{
			$this->_value |= $value;
		}

		/**
		 * Unsets a flag.
		 * @param int $value The flag to unset.
		 * @return void
		 */
		private function unvalidatedUnset( int $value ): void
		{
			$this->_value &= ~$value;
		}

		/**
		 * Switches a flag.
		 * @param int $value The flag to switch.
		 * @return void
		 */
		private function unvalidatedSwitch( int $value ): void
		{
			$this->_value ^= $value;
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::has()
		 * @throws InvalidValueException The value is invalid.
		 */
		final public function has( $value ): bool
		{
			$this->validateValue( $value );

			return $this->unvalidatedHas( $this->getExtractedValue( $value ) );
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::set()
		 * @throws InvalidValueException The value is invalid.
		 */
		final public function set( $value ): FlagableInterface
		{
			$this->validateValue( $value );
			$this->unvalidatedSet( $this->getExtractedValue( $value ) );

			return $this;
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::unset()
		 * @throws InvalidValueException The value is invalid.
		 */
		final public function unset( $value ): FlagableInterface
		{
			$this->validateValue( $value );
			$this->unvalidatedUnset( $this->getExtractedValue( $value ) );

			return $this;
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::switch()
		 * @throws InvalidValueException The value is invalid.
		 */
		final public function switch( $value ): FlagableInterface
		{
			$this->validateValue( $value );
			$this->unvalidatedSwitch( $this->getExtractedValue( $value ) );

			return $this;
		}

		/**
		 * {@inheritdoc}
		 * @see FlagableInterface::getIterator()
		 */
		final public function getIterator(): iterable
		{
			if ( $this->_value === static::NONE )
			{
				yield new static;

				return;
			}
			foreach ( static::$_reflectedFlags as $reflectedFlagValue )
			{
				if ( static::NONE !== $reflectedFlagValue && $this->unvalidatedHas( $reflectedFlagValue ) === true )
				{
					yield new static( $reflectedFlagValue );
				}
			}
		}
	}
}
