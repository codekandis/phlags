<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\Types\BaseObject;
use CodeKandis\Types\MethodNotFoundException;
use CodeKandis\Types\PropertyNotFoundException;
use Override;
use ReflectionClass;
use Traversable;
use function ctype_digit;
use function explode;
use function implode;
use function is_int;
use function is_string;

/**
 * Represents the base class of all flagable classes.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractFlagable extends BaseObject implements FlagableInterface
{
	/**
	 * Stores the states of all instantiated flagables.
	 * @var FlagableStateInterface[]
	 */
	protected static array $flagableStates = [];

	/**
	 * Stores the current value of the flagable.
	 */
	private int $value = 0;

	/**
	 * Constructor method.
	 * @param int|string|FlagableInterface $value The initial value of the flagable.
	 * @throws InvalidFlagableExceptionInterface The flagable is invalid.
	 * @throws InvalidValueExceptionInterface The value is invalid.
	 */
	final public function __construct( int|string|FlagableInterface $value = self::NONE )
	{
		static::initializeReflectedFlags();
		static::validateFlagable();
		static::getFlagableState()->setValueValidator( new ValueValidator() );
		$this->set( $value );
	}

	/**
	 * Gets the state of the flagable.
	 * @return FlagableStateInterface The state of the flagable.
	 */
	private static function getFlagableState(): FlagableStateInterface
	{
		return static::$flagableStates[ static::class ] ?? static::$flagableStates[ static::class ] = new FlagableState();
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function __unset( string $memberName ): void
	{
		throw PropertyNotFoundException::with_classNameAndPropertyName( static::class, $memberName );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function __get( string $memberName ): mixed
	{
		throw PropertyNotFoundException::with_classNameAndPropertyName( static::class, $memberName );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function __set( string $memberName, mixed $value ): void
	{
		throw PropertyNotFoundException::with_classNameAndPropertyName( static::class, $memberName );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function __call( string $methodName, array $arguments ): mixed
	{
		throw MethodNotFoundException::with_classNameAndMethodName( static::class, $methodName );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public static function __callStatic( string $methodName, array $arguments ): mixed
	{
		throw MethodNotFoundException::with_classNameAndMethodName( static::class, $methodName );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function __toString(): string
	{
		$flagsSetNames = [];

		/**
		 * @var string $reflectedFlagName
		 * @var int $reflectedFlagValue
		 */
		foreach ( static::getFlagableState()->getReflectedFlags() as $reflectedFlagName => $reflectedFlagValue )
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
	 * @inheritDoc
	 */
	#[Override]
	final public function __invoke(): int
	{
		return $this->getValue();
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function getValue(): int
	{
		return $this->value;
	}

	/**
	 * Initializes the reflected flags for validation and stringification.
	 */
	private static function initializeReflectedFlags(): void
	{
		static::getFlagableState()->setReflectedFlags(
			( new ReflectionClass( static::class ) )
				->getConstants()
		);
	}

	/**
	 * Validates the flagable.
	 * @throws InvalidFlagableExceptionInterface The flagable is invalid.
	 */
	private static function validateFlagable(): void
	{
		$flagableState = static::getFlagableState();

		if ( true === $flagableState->getHasBeenValidated() && null !== $flagableState->getValidationException() )
		{
			throw $flagableState->getValidationException();
		}

		$flagableState->setHasBeenValidated( true );
		$validator = new FlagableValidator();
		$validator->validate(
			static::class,
			$flagableState->getReflectedFlags()
		);

		if ( false === $validator->succeeded() )
		{
			$validationException = InvalidFlagableException
				::with_invalidFlagableClassName( static::class )
				->setContextErrorMessages(
					...$validator->getErrorMessages()
				);
			$flagableState->setValidationException( $validationException );
			throw $validationException;
		}

		$flagableState->setMaximumValue( $validator->getMaximumValue() );
	}

	/**
	 * Validates a value.
	 * @param int|string|FlagableInterface $value The value to validate.
	 * @throws InvalidValueExceptionInterface The value is invalid.
	 */
	private function validateValue( int|string|FlagableInterface $value ): void
	{
		$valueValidator = static::getFlagableState()->getValueValidator();
		$valueValidator->validate( $this, static::getFlagableState()->getReflectedFlags(), static::getFlagableState()->getMaximumValue(), $value );
		if ( false === $valueValidator->succeeded() )
		{
			throw InvalidValueException
				::with_invalidValue( $value )
				->setContextErrorMessages(
					...$valueValidator->getErrorMessages()
				);
		}
	}

	/**
	 * Gets the extracted value of a value.
	 * @param mixed $value The value to extract.
	 * @return int The extracted value.
	 */
	private function getExtractedValue( mixed $value ): int
	{
		$returnValue = null;

		if ( true === is_int( $value ) )
		{
			$returnValue = $value;
		}

		if ( true === is_string( $value ) )
		{
			$extractedValue = static::NONE;

			foreach ( explode( '|', $value ) as $explodedValue )
			{
				if ( false === ctype_digit( $explodedValue ) )
				{
					$extractedValue |= static::getFlagableState()->getReflectedFlags()[ $explodedValue ];
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
	 * @return bool True if the value has been set, otherwise false.
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
	 * @inheritDoc
	 */
	#[Override]
	final public function has( int|string|FlagableInterface $value ): bool
	{
		$this->validateValue( $value );

		return $this->unvalidatedHas( $this->getExtractedValue( $value ) );
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function set( int|string|FlagableInterface $value ): static
	{
		$this->validateValue( $value );
		$this->unvalidatedSet( $this->getExtractedValue( $value ) );

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function unset( int|string|FlagableInterface $value ): static
	{
		$this->validateValue( $value );
		$this->unvalidatedUnset( $this->getExtractedValue( $value ) );

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function switch( int|string|FlagableInterface $value ): static
	{
		$this->validateValue( $value );
		$this->unvalidatedSwitch( $this->getExtractedValue( $value ) );

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	final public function getIterator(): Traversable
	{
		if ( static::NONE === $this->value )
		{
			yield new static;

			return;
		}

		/**
		 * @var int $reflectedFlagValue
		 */
		foreach ( static::getFlagableState()->getReflectedFlags() as $reflectedFlagValue )
		{
			if ( static::NONE !== $reflectedFlagValue && true === $this->unvalidatedHas( $reflectedFlagValue ) )
			{
				yield new static( $reflectedFlagValue );
			}
		}
	}
}
