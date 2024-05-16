<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use Override;
use function in_array;
use function is_int;
use function sprintf;

/**
 * Represents the validator of any flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidator extends AbstractValidator implements FlagableValidatorInterface
{
	/**
	 * Represents the error message if a flag value is a duplicate.
	 */
	public const string ERROR_MESSAGE_DUPLICATE_FLAG = 'The flag value `%s` in the flag `%s::%s` is a duplicate.';

	/**
	 * Represents the error message if the type of a flag is invalid.
	 */
	public const string ERROR_MESSAGE_INVALID_TYPE = 'The type of the flag `%s::%s` is invalid. Unsigned `int` expected.';

	/**
	 * Represents the error message if a flag value is invalid.
	 */
	public const string ERROR_MESSAGE_INVALID_VALUE = 'The flag value `%s` in the flag `%s::%s` is invalid. A power of `2` expected.';

	/**
	 * Represents the error message if a flag value is missing.
	 */
	public const string ERROR_MESSAGE_MISSING_FLAG = 'The flag value `%s` is missing in the flagable `%s`.';

	/**
	 * Stores the maximum flag value of the flagable.
	 */
	private int $maximumValue = 0;

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getMaximumValue(): int
	{
		return $this->maximumValue;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
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
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_DUPLICATE_FLAG, $flagValue, $flagableClassName, $flagName );

				continue;
			}

			if ( false === is_int( $flagValue ) || 0 > $flagValue )
			{
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_INVALID_TYPE, $flagableClassName, $flagName );

				continue;
			}

			if ( 0 !== ( $flagValue & ( $flagValue - 1 ) ) )
			{
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_INVALID_VALUE, $flagValue, $flagableClassName, $flagName );

				continue;
			}

			$validatedFlags[]   = $flagValue;
			$this->maximumValue |= $flagValue;
		}

		for ( $n = 1; 0 | $n <= $this->maximumValue; $n *= 2 )
		{
			if ( 0 === ( $n & $this->maximumValue ) )
			{
				$this->errorMessages[] = sprintf( static::ERROR_MESSAGE_MISSING_FLAG, $n, $flagableClassName );
			}
		}
	}
}
