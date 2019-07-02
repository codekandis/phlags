<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Validation\Results\ValidationResultInterface;
use CodeKandis\Phlags\Validation\Results\ValueValidationResult;
use function array_key_exists;
use function explode;
use function get_class;
use function is_int;
use function is_numeric;
use function is_string;
use function sprintf;

/**
 * Represents the validator of all flagables.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
final class ValueValidator implements ValueValidatorInterface
{
	/**
	 * {@inheritdoc}
	 * @see ValueValidatorInterface::validate()
	 */
	public function validate( FlagableInterface $flagable, array $reflectedFlags, int $maxValue, $value ): ValidationResultInterface
	{
		$errorMessages = [];

		if ( false === $value instanceof $flagable )
		{
			$isString = is_string( $value );
			$isInt    = is_int( $value );
			if ( false === $isString && ( false === $isInt || 0 > $value ) )
			{
				$errorMessages[] = sprintf(
					"Invalid type in value '%s'. Unsigned 'int', 'string' or instance of '%s' expected.",
					(string) $value,
					get_class( $flagable )
				);
			}
			else if ( true === $isString )
			{
				foreach ( explode( '|', $value ) as $explodedValue )
				{
					if ( false === ctype_digit( $explodedValue ) )
					{
						if ( true === is_numeric( $explodedValue ) )
						{
							$errorMessages[] = sprintf(
								"Invalid type in stringified value '%s'. Unsigned 'int' or flag name of flagable '%s' expected.",
								(string) $explodedValue,
								get_class( $flagable )
							);
							continue;
						}
						if ( false === array_key_exists( $explodedValue, $reflectedFlags ) )
						{
							$errorMessages[] = sprintf(
								"The value '%s' cannot be resolved to a flag value.",
								$explodedValue
							);
							continue;
						}
					}
					if ( $maxValue < (int) $explodedValue )
					{
						$errorMessages[] = sprintf(
							"The value '%s' exceeds the maximum flag value of '%s'.",
							(string) $explodedValue,
							(string) $maxValue
						);
					}
				}
			}
			else if ( $maxValue < $value )
			{
				$errorMessages[] = sprintf(
					"The value '%s' exceeds the maximum flag value of '%s'.",
					(string) $value,
					(string) $maxValue
				);
			}
		}

		return new ValueValidationResult( $errorMessages );
	}
}
