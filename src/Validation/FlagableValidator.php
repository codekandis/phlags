<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use function in_array;
use function is_int;
use function sprintf;

/**
 * Represents the validator of all flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidator extends AbstractValidator implements FlagableValidatorInterface
{
	/**
	 * Stores the maximum value of the flagable.
	 * @var int
	 */
	private $maxValue;

	/**
	 * {@inheritdoc}
	 */
	public function getMaxValue(): int
	{
		return $this->maxValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function validate( string $flagableClassName, array $reflectedFlags ): void
	{
		$this->errorMessages = [];
		$validatedFlags      = [];

		/**
		 * @var string $flagName
		 * @var int $flagValue
		 */
		foreach ( $reflectedFlags as $flagName => $flagValue )
		{
			if ( true === in_array( $flagValue, $validatedFlags, true ) )
			{
				$this->errorMessages[] =
					sprintf( "Duplicate flag '%s' in '%s::%s'.", $flagValue, $flagableClassName, $flagName );
				continue;
			}

			if ( false === is_int( $flagValue ) || 0 > $flagValue )
			{
				$this->errorMessages[] =
					sprintf( "Invalid type in '%s::%s'. Unsigned 'int' expected.", $flagableClassName, $flagName );
				continue;
			}

			if ( 0 !== ( $flagValue & ( $flagValue - 1 ) ) )
			{
				$this->errorMessages[] =
					sprintf(
						"Invalid value '%s' in flag in '%s::%s'. Flag must be a power of 2.",
						$flagValue,
						$flagableClassName,
						$flagName
					);
				continue;
			}

			$validatedFlags[] = $flagValue;
			$this->maxValue   |= $flagValue;
		}

		for ( $n = 1; 0 | $n <= $this->maxValue; $n *= 2 )
		{
			if ( 0 === ( $n & $this->maxValue ) )
			{
				$this->errorMessages[] =
					sprintf(
						"Missing flag with value '%s' in '%s'.",
						$n,
						$flagableClassName
					);
			}
		}
	}
}
