<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation
{

	use CodeKandis\Phlags\FlagableInterface;
	use CodeKandis\Phlags\Validation\Results\ValidationResultInterface;
	use CodeKandis\Phlags\Validation\Results\ValueValidationResult;

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
			if ( $value instanceof $flagable )
			{
				return new ValueValidationResult( [] );
			}
			$isString = is_string( $value );
			$isInt    = is_int( $value );
			if ( $isString === false && ( $isInt === false || $value < 0 ) )
			{
				return new ValueValidationResult( [
					sprintf( "Invalid type in value '%s'. Unsigned 'int', 'string' or instance of '%s' expected.", (string) $value, get_class( $flagable ) ),
				] );
			}
			if ( $isString === true )
			{
				$explodedValues = explode( '|', $value );
				$errorMessages  = [];
				foreach ( $explodedValues as $explodedValue )
				{
					if ( ctype_digit( $explodedValue ) === false )
					{
						if ( is_numeric( $explodedValue ) )
						{
							$errorMessages[] = sprintf( "Invalid type in stringified value '%s'. Unsigned 'int' or flag name of flagable '%s' expected.", (string) $explodedValue, get_class( $flagable ) );
							continue;
						}
						if ( array_key_exists( $explodedValue, $reflectedFlags ) === false )
						{
							$errorMessages[] = sprintf( "The value '%s' cannot be resolved to a flag value.", $explodedValue );
							continue;
						}
					}
					if ( (int) $explodedValue > $maxValue )
					{
						$errorMessages[] = sprintf( "The value '%s' exceeds the maximum flag value of '%s'.", (string) $explodedValue, (string) $maxValue );
					}
				}
				if ( empty( $errorMessages ) === false )
				{
					return new ValueValidationResult( $errorMessages );
				}
			}
			if ( $value > $maxValue )
			{
				return new ValueValidationResult( [
					sprintf( "The value '%s' exceeds the maximum flag value of '%s'.", (string) $value, (string) $maxValue ),
				] );
			}

			return new ValueValidationResult( [] );
		}
	}
}
