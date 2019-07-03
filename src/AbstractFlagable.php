<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Exceptions\InvalidFlagableException;
use CodeKandis\Phlags\Exceptions\InvalidValueException;
use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use ReflectionClass;
use ReflectionException;
use function asort;
use function explode;
use function implode;
use function is_int;
use function is_string;

/**
 * Represents the base class of all flagable classes.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractFlagable implements FlagableInterface
{
	/**
	 * Stores if the flagable has been validated.
	 * @var bool
	 */
	protected static $hasBeenValidated = false;

	/**
	 * Stores the thrown exception of the validation of the flagable.
	 * @var InvalidFlagableException
	 */
	protected static $validationException;

	/**
	 * Stores the reflected flags of the flagable.
	 * @var array
	 */
	protected static $reflectedFlags;

	/**
	 * Stores the maximum value of the flagable.
	 * @var int
	 */
	protected static $maxValue = self::NONE;

	/**
	 * Stores the value validator of the flagable.
	 * @var ValueValidatorInterface
	 */
	protected static $valueValidator;

	/**
	 * Stores the current value of the flagable.
	 * @var int
	 */
	private $value;

	/**
	 * Constructor method.
	 * @param int|string|FlagableInterface $value The initial value of the flagable.
	 * @throws InvalidFlagableException The flagable is invalid.
	 * @throws InvalidValueException The value is invalid.
	 */
	final public function __construct( $value = self::NONE )
	{
		static::initializeReflectedFlags();
		static::validateFlagable();
		self::$valueValidator = self::$valueValidator ?? new ValueValidator();
		$this->set( $value );
	}

	/**
	 * Determines if an undefined member has been set.
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
	 * @param mixed $value The value to set.
	 * @throws UnsupportedOperationException Accessing undefined members is not supported.
	 */
	final public function __set( string $memberName, $value ): void
	{
		throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
	}

	/**
	 * Calls an undefined method.
	 * @param string $methodName The name of the undefined method.
	 * @param array $arguments The passed arguments.
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
	 * @param array $arguments The passed arguments.
	 * @return mixed The return value of the undefined static method.
	 * @throws UnsupportedOperationException Accessing undefined methods is not supported.
	 */
	final public static function __callStatic( string $methodName, array $arguments )
	{
		throw new UnsupportedOperationException( 'Accessing undefined methods is not supported.' );
	}

	/**
	 * {@inheritdoc}
	 */
	final public function __toString(): string
	{
		$flagsSetNames = [];
		/**
		 * @var string $reflectedFlagName
		 * @var int $reflectedFlagValue
		 */
		foreach ( static::$reflectedFlags as $reflectedFlagName => $reflectedFlagValue )
		{
			if ( 0 !== $reflectedFlagValue && ( $this->value & $reflectedFlagValue ) === $reflectedFlagValue )
			{
				$flagsSetNames[] = $reflectedFlagName;
			}
		}

		return true === empty( $flagsSetNames )
			? 'NONE'
			: implode( '|', $flagsSetNames );
	}

	/**
	 * {@inheritdoc}
	 */
	final public function __invoke(): int
	{
		return $this->getValue();
	}

	/**
	 * {@inheritdoc}
	 */
	final public function getValue(): int
	{
		return $this->value;
	}

	/**
	 * Initializes the reflected flags for validation and stringification.
	 */
	private static function initializeReflectedFlags(): void
	{
		try
		{
			static::$reflectedFlags = ( new ReflectionClass( static::class ) )->getConstants();
			asort( static::$reflectedFlags );
		}
		catch ( ReflectionException $exception )
		{
		}
	}

	/**
	 * Validates the flagable.
	 * @throws InvalidFlagableException The flagable is invalid.
	 */
	private static function validateFlagable(): void
	{
		if ( true === static::$hasBeenValidated && null !== static::$validationException )
		{
			throw static::$validationException;
		}
		static::$hasBeenValidated = true;
		$validationResult         = ( new FlagableValidator )->validate( static::class, static::$reflectedFlags );
		if ( true === $validationResult->failed() )
		{
			throw ( new InvalidFlagableException( 'Invalid flagable.' ) )->withErrorMessages( $validationResult->getErrorMessages() );
		}
		static::$maxValue = $validationResult->getMaxValue();
	}

	/**
	 * Validates a value.
	 * @param int|string|FlagableInterface $value The value to validate.
	 * @throws InvalidValueException The value is invalid.
	 */
	private function validateValue( $value ): void
	{
		$validationResult = self::$valueValidator->validate( $this, static::$reflectedFlags, self::$maxValue, $value );
		if ( true === $validationResult->failed() )
		{
			throw ( new InvalidValueException( 'Invalid value.' ) )->withErrorMessages( $validationResult->getErrorMessages() );
		}
	}

	/**
	 * Gets the extracted value of a value.
	 * @param mixed $value The value to extract.
	 * @return int The extracted value.
	 */
	private function getExtractedValue( $value ): int
	{
		$returnValue = null;

		if ( true === is_int( $value ) )
		{
			$returnValue = $value;
		}

		if ( true === is_string( $value ) )
		{
			$extractedValue = FlagableInterface::NONE;
			/**
			 * @var string $explodedValue
			 */
			foreach ( explode( '|', $value ) as $explodedValue )
			{
				if ( false === ctype_digit( $explodedValue ) )
				{
					$extractedValue |= static::$reflectedFlags[ $explodedValue ];
					continue;
				}
				$extractedValue |= (int) $explodedValue;
			}

			$returnValue = $extractedValue;
		}

		return $returnValue ?? $value->getValue();
	}

	/**
	 * Determines if a value has been set.
	 * @param int $value The value to check if it has been set.
	 * @return bool true if the value has been set, false otherwise.
	 */
	private function unvalidatedHas( int $value ): bool
	{
		return ( $this->value & $value ) === $value;
	}

	/**
	 * Sets a flag.
	 * @param int $value The flag to set.
	 */
	private function unvalidatedSet( int $value ): void
	{
		$this->value |= $value;
	}

	/**
	 * Unsets a flag.
	 * @param int $value The flag to unset.
	 */
	private function unvalidatedUnset( int $value ): void
	{
		$this->value &= ~$value;
	}

	/**
	 * Switches a flag.
	 * @param int $value The flag to switch.
	 */
	private function unvalidatedSwitch( int $value ): void
	{
		$this->value ^= $value;
	}

	/**
	 * {@inheritdoc}
	 * @throws InvalidValueException The value is invalid.
	 */
	final public function has( $value ): bool
	{
		$this->validateValue( $value );

		return $this->unvalidatedHas( $this->getExtractedValue( $value ) );
	}

	/**
	 * {@inheritdoc}
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
	 */
	final public function getIterator(): iterable
	{
		if ( static::NONE === $this->value )
		{
			yield new static;

			return;
		}
		/**
		 * @var int $reflectedFlagValue
		 */
		foreach ( static::$reflectedFlags as $reflectedFlagValue )
		{
			if ( static::NONE !== $reflectedFlagValue && true === $this->unvalidatedHas( $reflectedFlagValue ) )
			{
				yield new static( $reflectedFlagValue );
			}
		}
	}
}
