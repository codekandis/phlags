<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Unit\Validation
{

	use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
	use CodeKandis\Phlags\Validation\Results\ValueValidationResult;
	use CodeKandis\Phlags\Validation\ValueValidator;
	use PHPUnit\Framework\TestCase;

	/**
	 * Represents the test case for the class 'CodeKandis\Phlags\Validation\ValueValidator'.
	 * @package codekandis/phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	class ValueValidatorTest extends TestCase
	{
		/**
		 * Tests if the flagable validator is working as expected.
		 * @param string $validationResultClassName The class name of the validation result.
		 * @param string $flagableClassName         The class name of the flagable to validate.
		 * @param array  $reflectedFlags            The reflected flags of the flagable.
		 * @param int    $maxValue                  The maximum value of the flagable.
		 * @param mixed  $value                     The value to validate.
		 * @param array  $errorMessages             The error messages of the validation.
		 * @param bool   $succeeded                 The success state of the validation.
		 * @param bool   $failed                    The fail state of the validiation.
		 * @dataProvider valuesAndResultsDataProvider
		 */
		public function testsProperValidation( string $validationResultClassName, string $flagableClassName, array $reflectedFlags, int $maxValue, $value, array $errorMessages, bool $succeeded, bool $failed ): void
		{
			$flagable         = new $flagableClassName;
			$validationResult = ( new ValueValidator )->validate( $flagable, $reflectedFlags, $maxValue, $value );
			$this->assertInstanceOf( $validationResultClassName, $validationResult );
			$this->assertEquals( $errorMessages, $validationResult->getErrorMessages() );
			$this->assertEquals( $succeeded, $validationResult->succeeded() );
			$this->assertEquals( $failed, $validationResult->failed() );
		}

		/**
		 * Provides the data to validate a value.
		 * @return array The data sets.
		 */
		public function valuesAndResultsDataProvider(): array
		{
			return [
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => ValidPermissions::DIRECTORY,
					'errorMessages'             => [],
					'succeeded'                 => true,
					'failed'                    => false,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => new ValidPermissions( ValidPermissions::DIRECTORY ),
					'errorMessages'             => [],
					'succeeded'                 => true,
					'failed'                    => false,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 'DIRECTORY',
					'errorMessages'             => [],
					'succeeded'                 => true,
					'failed'                    => false,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 'DIRECTORY|UREAD',
					'errorMessages'             => [],
					'succeeded'                 => true,
					'failed'                    => false,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 'foobar',
					'errorMessages'             => [
						"The value 'foobar' cannot be resolved to a flag value.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 'DIRECTORY|UEXECUTE',
					'errorMessages'             => [
						"The value 'UEXECUTE' cannot be resolved to a flag value.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => -42,
					'errorMessages'             => [
						"Invalid type in value '-42'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => -42.5,
					'errorMessages'             => [
						"Invalid type in value '-42.5'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => '-42',
					'errorMessages'             => [
						"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => '-42.5',
					'errorMessages'             => [
						"Invalid type in stringified value '-42.5'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 42,
					'errorMessages'             => [
						"The value '42' exceeds the maximum flag value of '7'.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
				[
					'validationResultClassName' => ValueValidationResult::class,
					'flagableClassName'         => ValidPermissions::class,
					'reflectedFlags'            => [
						'DIRECTORY' => 1,
						'UREAD'     => 2,
						'UWRITE'    => 4,
					],
					'maxValue'                  => 7,
					'value'                     => 'DIRECTORY|-42|UEXECUTE',
					'errorMessages'             => [
						"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
						"The value 'UEXECUTE' cannot be resolved to a flag value.",
					],
					'succeeded'                 => false,
					'failed'                    => true,
				],
			];
		}
	}
}
