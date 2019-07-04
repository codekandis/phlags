<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\Tests\Fixtures\InvalidFlagable;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use CodeKandis\Phlags\Validation\FlagableValidator;
use PHPUnit\Framework\TestCase;
use function sprintf;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Validation\FlagableValidator'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidatorTest extends TestCase
{
	/**
	 * Tests if the flagable validator is working as expected.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable to validate.
	 * @param array $errorMessages The error messages of the validation.
	 * @param int $expectedMaxValue The maximum value of the flagable.
	 * @param bool $expectedSucceeded The success state of the validation.
	 * @dataProvider flagableDataProvider
	 */
	public function testsProperValidation( string $flagableClassName, array $reflectedFlags, array $errorMessages, int $expectedMaxValue, bool $expectedSucceeded ): void
	{
		$validator = new FlagableValidator();
		$validator->validate( $flagableClassName, $reflectedFlags );

		static::assertEquals( $errorMessages, $validator->getErrorMessages() );
		static::assertEquals( $expectedMaxValue, $validator->getMaxValue() );
		static::assertEquals( $expectedSucceeded, $validator->succeeded() );
	}

	/**
	 * Provides the data to validate a flagable.
	 * @return array The data sets.
	 */
	public function flagableDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => ValidFlagable::class,
				'reflectedFlags'    => [
					'NONE'   => 0,
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'errorMessages'     => [],
				'expectedMaxValue'  => 7,
				'expectedSucceeded' => true
			],
			1 => [
				'flagableClassName' => InvalidFlagable::class,
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 2,
					'FLAG_D' => 5,
					'FLAG_E' => 8,
					'FLAG_F' => 32,
				],
				'errorMessages'     => [
					sprintf(
						"Duplicate flag '2' in '%s::%s'.",
						InvalidFlagable::class,
						'FLAG_C'
					),
					sprintf(
						"Invalid value '5' in flag in '%s::%s'. Flag must be a power of 2.",
						InvalidFlagable::class,
						'FLAG_D'
					),
					sprintf(
						"Missing flag with value '%d' in '%s'.",
						4,
						InvalidFlagable::class
					),
					sprintf(
						"Missing flag with value '%d' in '%s'.",
						16,
						InvalidFlagable::class
					),
				],
				'expectedMaxValue'  => 43,
				'expectedSucceeded' => false
			]
		];
	}
}
