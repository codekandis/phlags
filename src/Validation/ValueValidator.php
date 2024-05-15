<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\FlagableInterface;
use Override;
use function array_key_exists;
use function ctype_digit;
use function explode;
use function is_int;
use function is_numeric;
use function is_string;
use function sprintf;

/**
 * Represents the validator of all flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValueValidator extends AbstractValidator implements ValueValidatorInterface
{
	/**
	 * Represents the error message if the type of a value is invalid.
	 * @var string
	 */
	public const string ERROR_MESSAGE_INVALID_VALUE_TYPE = 'The type of the value `%s` is invalid. Unsigned `int`, `string` or instance of `%s` expected.';

	/**
	 * Represents the error message if the type of a stringified value is invalid.
	 * @var string
	 */
	public const string ERROR_MESSAGE_INVALID_STRINGIFIED_VALUE_TYPE = 'The type of the stringified value `%s` is invalid. Unsigned `int` or flag name of flagable `%s` expected.';

	/**
	 * Represents the error message if a value cannot be resolved to a flag value.
	 * @var string
	 */
	public const string ERROR_MESSAGE_UNRESOLVABLE_VALUE = 'The value `%s` cannot be resolved to a flag value.';

	/**
	 * Represents the error message if a value exceeds a maximum flag value.
	 * @var string
	 */
	public const string ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE = 'The value `%s` exceeds the maximum flag value of `%s`.';

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function validate( FlagableInterface $flagable, array $reflectedFlags, int $maximumValue, mixed $value ): void
	{
		$this->errorMessages = [];

		if ( false === $value instanceof $flagable )
		{
			$isString = is_string( $value );
			$isInt    = is_int( $value );

			if ( false === $isString && ( false === $isInt || 0 > $value ) )
			{
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_INVALID_VALUE_TYPE, (string) $value, $flagable::class );

				return;
			}

			if ( true === $isString )
			{
				/**
				 * @var string $explodedValue
				 */
				foreach ( explode( '|', $value ) as $explodedValue )
				{
					if ( false === ctype_digit( $explodedValue ) )
					{
						if ( true === is_numeric( $explodedValue ) )
						{
							$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_INVALID_STRINGIFIED_VALUE_TYPE, $explodedValue, $flagable::class );
							continue;
						}

						if ( false === array_key_exists( $explodedValue, $reflectedFlags ) )
						{
							$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_UNRESOLVABLE_VALUE, $explodedValue );
							continue;
						}
					}

					if ( $maximumValue < (int) $explodedValue )
					{
						$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE, $explodedValue, (string) $maximumValue );
					}
				}

				return;
			}

			if ( $maximumValue < $value )
			{
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE, (string) $value, (string) $maximumValue );
			}
		}
	}
}
