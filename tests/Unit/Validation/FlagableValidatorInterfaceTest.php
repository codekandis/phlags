<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\Tests\Fixtures\InvalidFlagable;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\Phlags\Validation\FlagableValidatorInterface;
use PHPUnit\Framework\TestCase;
use function sprintf;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\Validation\FlagableValidatorInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidatorInterfaceTest extends TestCase
{
	/**
	 * Provides flagable validators, flagables with flags to validate, error messages, maximum flag values and success states.
	 * @return array The flagable validators, flagables with flags to validate, error messages, maximum flag values and success states.
	 */
	public function flagableValidatorDataProvider(): array
	{
		return [
			0 => [
				'flagableValidator' => new FlagableValidator(),
				'flagableClassName' => get_class(
					new class()
					{
					}
				),
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
				'flagableValidator' => new FlagableValidator(),
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
			2 => [
				'flagableValidator' => new FlagableValidator(),
				'flagableClassName' => InvalidFlagable::class,
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 2,
					'FLAG_D' => 5,
					'FLAG_E' => 8,
					'FLAG_F' => 32,
					'FLAG_G' => -42,
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
						"Invalid type in '%s::%s'. Unsigned 'int' expected.",
						InvalidFlagable::class,
						'FLAG_G'
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
					)
				],
				'expectedMaxValue'  => 43,
				'expectedSucceeded' => false
			]
		];
	}

	/**
	 * Tests if the flagable validator is validating flagables with correct error messages, maximum flag values and success states.
	 * @param FlagableValidatorInterface $flagableValidator The validator implementing `FlagableValidatorInterface`.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable to validate.
	 * @param array $expectedErrorMessages The expected error messages of the validation.
	 * @param int $expectedMaxValue The expected maximum value of the flagable.
	 * @param bool $expectedSucceeded The expected success state of the validation.
	 * @dataProvider flagableValidatorDataProvider
	 */
	public function testFlagableValidatorsValidateAndReturnValidationResultsCorrectly( FlagableValidatorInterface $flagableValidator, string $flagableClassName, array $reflectedFlags, array $expectedErrorMessages, int $expectedMaxValue, bool $expectedSucceeded ): void
	{
		$flagableValidator->validate( $flagableClassName, $reflectedFlags );

		$resultedErrorMessages = $flagableValidator->getErrorMessages();
		$resultedMaxValue      = $flagableValidator->getMaxValue();
		$resultedSucceeded     = $flagableValidator->succeeded();

		static::assertEquals( $expectedErrorMessages, $resultedErrorMessages );
		static::assertEquals( $expectedMaxValue, $resultedMaxValue );
		static::assertEquals( $expectedSucceeded, $resultedSucceeded );
	}
}
