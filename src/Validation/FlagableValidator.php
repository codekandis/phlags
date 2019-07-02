<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\Validation\Results\FlagableValidationResult;
use CodeKandis\Phlags\Validation\Results\FlagableValidationResultInterface;
use function in_array;
use function is_int;
use function sprintf;

/**
 * Represents the validator of all flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidator implements FlagableValidatorInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function validate( string $flagableClassName, array $reflectedFlags ): FlagableValidationResultInterface
	{
		$errorMessages  = [];
		$maxValue       = 0;
		$validatedFlags = [];
		/**
		 * @var string $flagName
		 * @var int $flagValue
		 */
		foreach ( $reflectedFlags as $flagName => $flagValue )
		{
			if ( true === in_array( $flagValue, $validatedFlags, true ) )
			{
				$errorMessages[] =
					sprintf( "Duplicate flag '%s' in '%s::%s'.", $flagValue, $flagableClassName, $flagName );
				continue;
			}
			if ( false === is_int( $flagValue ) || 0 > $flagValue )
			{
				$errorMessages[] =
					sprintf( "Invalid type in '%s::%s'. Unsigned 'int' expected.", $flagableClassName, $flagName );
				continue;
			}
			if ( 0 !== ( $flagValue & ( $flagValue - 1 ) ) )
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
			if ( 0 === ( $n & $maxValue ) )
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
