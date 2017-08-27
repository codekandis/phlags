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
     * Class AbstractFlags
     * @package Represents the base claa of all flagable classes.
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
         * Stores the maximum value of the flagable.
         * @var int
         */
        protected static $_maxValue = self::NONE;

        /**
         * Stores the current value of the flagable.
         * @var int
         */
        private $_value;

        /**
         * Stores the value validator of the flagable.
         * @var ValueValidatorInterface
         */
        protected static $_valueValidator;

        /**
         * Constructor method.
         * @param int|FlagableInterface $value The initial value of the flagable.
         * @throws InvalidFlagableException The flagable is invalid.
         * @throws InvalidValueException The value is invalid.
         */
        final public function __construct( $value = self::NONE )
        {
            static::validateFlagable();
            static::$_valueValidator = static::$_valueValidator ?? new ValueValidator();
            $this->set( $value );
        }

        /**
         * Determines if a undefined member has been set.
         * @param string $memberName Gets the name of the undefined member.
         * @return bool false while accessing undefined members is not supported.
         */
        public function __isset( string $memberName ): bool
        {
            return false;
        }

        /**
         * Unsets an undefined member.
         * @param string $memberName The name of the undefined member.
         * @return mixed The value of the undefined member.
         * @throws UnsupportedOperationException Accessing undefined members is not supported.
         */
        public function __unset( string $memberName ): void
        {
            throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
        }

        /**
         * Gets an undefined member.
         * @param string $memberName The name of the undefined member.
         * @return mixed The value of the undefined member.
         * @throws UnsupportedOperationException Accessing undefined members is not supported.
         */
        public function __get( string $memberName ): mixed
        {
            throw new UnsupportedOperationException( 'Accessing undefined members is not supported.' );
        }

        /**
         * Sets an undefined member.
         * @param string $memberName The name of the undefined member.
         * @param mixed  $value      The value to set.
         * @throws UnsupportedOperationException Accessing undefined members is not supported.
         */
        public function __set( string $memberName, $value ): void
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
        public function __call( string $methodName, array $arguments )
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
        public static function __callStatic( string $methodName, array $arguments )
        {
            throw new UnsupportedOperationException( 'Accessing undefined methods is not supported.' );
        }

        /**
         * Validates the flagable
         * @throws InvalidFlagableException The flagable is invalid.
         */
        private static function validateFlagable(): void
        {
            if ( static::$_hasBeenValidated === true && static::$_validationException !== null )
            {
                throw static::$_validationException;
            }
            static::$_hasBeenValidated = true;
            $validationResult          = ( new FlagableValidator() )->validate( static::class );
            if ( $validationResult->failed() === true )
            {
                throw ( new InvalidFlagableException( 'Invalid flagable.' ) )->withErrorMessages(
                    $validationResult->getErrorMessages()
                );
            }
            static::$_maxValue = $validationResult->getMaxValue();
        }

        /**
         * @see FlagableInterface::getValue()
         */
        public function getValue(): int
        {
            return $this->_value;
        }

        /**
         * @see FlagableInterface::__toString()
         */
        public function __toString(): string
        {
            return (string)$this->_value;
        }

        /**
         * @see FlagableInterface::__invoke()
         */
        public function __invoke(): int
        {
            return $this->getValue();
        }

        /**
         * Validates a value.
         * @param int|FlagableInterface $value The value to validate.
         * @throws InvalidValueException The value is invalid.
         */
        private function validateValue( $value ): void
        {
            $validationResult = static::$_valueValidator->validate( $this, self::$_maxValue, $value );
            if ( $validationResult->failed() === true )
            {
                throw ( new InvalidValueException( 'Invalid value.' ) )->withErrorMessages(
                    $validationResult->getErrorMessages()
                );
            }
        }

        /**
         * Gets the transformed value of a value.
         * @param mixed $value The value to transform.
         * @return int The transformed value.
         */
        private function getTransformedValue( $value ): int
        {
            return is_int( $value ) === true ? $value : $value->getValue();
        }

        /**
         * {@inheritdoc}
         * @see FlagableInterface::has()
         * @throws InvalidValueException The value is invalid.
         */
        public function has( $value ): bool
        {
            $this->validateValue( $value );
            $valueTransformed = $this->getTransformedValue( $value );

            return ( $this->_value & $valueTransformed ) === $valueTransformed;
        }

        /**
         * {@inheritdoc}
         * @see FlagableInterface::set()
         * @throws InvalidValueException The value is invalid.
         */
        public function set( $value ): FlagableInterface
        {
            $this->validateValue( $value );
            $this->_value |= $this->getTransformedValue( $value );

            return $this;
        }

        /**
         * {@inheritdoc}
         * @see FlagableInterface::unset()
         * @throws InvalidValueException The value is invalid.
         */
        public function unset( $value ): FlagableInterface
        {
            $this->validateValue( $value );
            $this->_value &= ~$this->getTransformedValue( $value );

            return $this;
        }

        /**
         * {@inheritdoc}
         * @see FlagableInterface::switch()
         * @throws InvalidValueException The value is invalid.
         */
        public function switch( $value ): FlagableInterface
        {
            $this->validateValue( $value );
            $this->_value ^= $this->getTransformedValue( $value );

            return $this;
        }
    }
}