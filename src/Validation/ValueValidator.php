<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation
{

	use CodeKandis\Phlags\FlagableInterface;
	use CodeKandis\Phlags\Validation\Results\ValidationResultInterface;
	use CodeKandis\Phlags\Validation\Results\ValueValidationResult;

	/**
	 * Represents the validator of all flagables.
	 *
	 * @package codekandis\phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	final class ValueValidator implements ValueValidatorInterface
	{
		/**
		 * {@inheritdoc}
		 * @see ValueValidatorInterface::validate()
		 */
		public function validate( FlagableInterface $flagable, int $maxValue, $value ): ValidationResultInterface
		{
			$errorMessages = [];
			if ( $value instanceof $flagable === false && ( is_int( $value ) === false || $value < 0 ) )
			{
				$errorMessages[] = sprintf(
					"Invalid type in value. Unsigned 'int' or instance of '%s' expected.",
					get_class( $flagable )
				);
			}
			if ( is_int( $value ) && $value > $maxValue )
			{
				$errorMessages[] = sprintf(
					"The value '%s' exceeds the maximum flag value of '%s'.",
					(string)$value,
					(string)$maxValue
				);
			}

			return new ValueValidationResult( $errorMessages );
		}
	}
}
