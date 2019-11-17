<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Unit\Validation
{

	use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
	use CodeKandis\Phlags\Validation\ValueValidator;
	use PHPUnit\Framework\TestCase;

	/**
	 * Represents the test case for the class 'CodeKandis\Phlags\Validation\ValueValidator'.
	 * @package codekandis\phlags
	 * @author  Christian Ramelow <info@codekandis.net>
	 */
	class ValueValidatorTest extends TestCase
	{
		/**
		 * Tests if the flagable validator is working as expected.
		 * @param string $flagableClassName The class name of the flagable to validate.
		 * @param int    $maxValue          The maximum value of the flagable.
		 * @param mixed  $value             The value to validate.
		 * @param array  $errorMessages     The error messages of the validation.
		 * @param bool   $succeeded         The success state of the validation.
		 * @param bool   $failed            The fail state of the validiation.
		 * @dataProvider valuesAndResultsDataProvider
		 */
		public function testsProperValidation(
			string $flagableClassName,
			int $maxValue,
			$value,
			array $errorMessages,
			bool $succeeded,
			bool $failed
		): void
		{
			$flagable         = new $flagableClassName();
			$validationResult = ( new ValueValidator() )->validate( $flagable, $maxValue, $value );
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
					'flagableClassName' => ValidPermissions::class,
					'maxValue'          => 7,
					'value'             => ValidPermissions::DIRECTORY,
					'errorMessages'     => [],
					'succeeded'         => true,
					'failed'            => false,
				],
				[
					'flagableClassName' => ValidPermissions::class,
					'maxValue'          => 7,
					'value'             => new ValidPermissions( ValidPermissions::DIRECTORY ),
					'errorMessages'     => [],
					'succeeded'         => true,
					'failed'            => false,
				],
				[
					'flagableClassName' => ValidPermissions::class,
					'maxValue'          => 7,
					'value'             => 'foobar',
					'errorMessages'     => [
						"Invalid type in value. Unsigned 'int' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'         => false,
					'failed'            => true,
				],
				[
					'flagableClassName' => ValidPermissions::class,
					'maxValue'          => 7,
					'value'             => -42,
					'errorMessages'     => [
						"Invalid type in value. Unsigned 'int' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					],
					'succeeded'         => false,
					'failed'            => true,
				],
				[
					'flagableClassName' => ValidPermissions::class,
					'maxValue'          => 7,
					'value'             => 42,
					'errorMessages'     => [
						"The value '42' exceeds the maximum flag value of '7'.",
					],
					'succeeded'         => false,
					'failed'            => true,
				],
			];
		}
	}
}
