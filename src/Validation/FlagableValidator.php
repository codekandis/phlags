<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation
{

	use CodeKandis\Phlags\Validation\Results\FlagableValidationResult;
	use CodeKandis\Phlags\Validation\Results\FlagableValidationResultInterface;

	/**
	 * Represents the validator of all flagables.
	 * @package codekandis\phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	class FlagableValidator implements FlagableValidatorInterface
	{
		/**
		 * {@inheritdoc}
		 * @see FlagableValidatorInterface::validate()
		 */
		public function validate( string $flagableClassName, array $flags ): FlagableValidationResultInterface
		{
			$errorMessages  = [];
			$maxValue       = 0;
			$validatedFlags = [];
			foreach ( $flags as $flagName => $flagValue )
			{
				if ( in_array( $flagValue, $validatedFlags, true ) === true )
				{
					$errorMessages[] =
						sprintf( "Duplicate flag '%s' in '%s::%s'.", $flagValue, $flagableClassName, $flagName );
					continue;
				}
				if ( is_int( $flagValue ) === false || $flagValue < 0 )
				{
					$errorMessages[] =
						sprintf( "Invalid type in '%s::%s'. Unsigned 'int' expected.", $flagableClassName, $flagName );
					continue;
				}
				if ( ( $flagValue & ( $flagValue - 1 ) ) !== 0 )
				{
					$errorMessages[] =
						sprintf(
							"Invalid value '%s' in flag in '%s::%s'. Flag must be a power of 2.",
							$flagValue,
							$flagableClassName,
							$flagName
						);
					continue;
				}
				$validatedFlags[] = $flagValue;
				$maxValue         |= $flagValue;
			}
			for ( $n = 1; 0 | $n <= $maxValue; $n *= 2 )
			{
				if ( ( $n & $maxValue ) === 0 )
				{
					$errorMessages[] =
						sprintf(
							"Missing flag with value '%s' in '%s'.",
							$n,
							$flagableClassName
						);
				}
			}

			return new FlagableValidationResult( $errorMessages, $maxValue );
		}
	}
}
