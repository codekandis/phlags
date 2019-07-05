<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the interface 'CodeKandis\Phlags\Validation\ValueValidatorInterface'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValueValidatorInterfaceTest extends TestCase
{
	/**
	 * Provides value validators, flagables, flags to validate, error messages, maximum flag values and success states.
	 * @return array The value validators, flagables, flags to validate, error messages, maximum flag values and success states.
	 */
	public function valuesAndResultsDataProvider(): array
	{
		return [
			0  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => ValidFlagable::FLAG_A,
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			1  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => new ValidFlagable( ValidFlagable::FLAG_A ),
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			2  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'FLAG_A',
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			3  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'FLAG_A|FLAG_B',
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			4  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'foobar',
				'errorMessages'     => [
					"The value 'foobar' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			],
			5  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'FLAG_A|FLAG_D',
				'errorMessages'     => [
					"The value 'FLAG_D' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			],
			6  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => -42,
				'errorMessages'     => [
					"Invalid type in value '-42'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidFlagable' expected.",
				],
				'expectedSucceeded' => false
			],
			7  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => -42.5,
				'errorMessages'     => [
					"Invalid type in value '-42.5'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidFlagable' expected.",
				],
				'expectedSucceeded' => false
			],
			8  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => '-42',
				'errorMessages'     => [
					"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidFlagable' expected.",
				],
				'expectedSucceeded' => false
			],
			9  => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => '-42.5',
				'errorMessages'     => [
					"Invalid type in stringified value '-42.5'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidFlagable' expected.",
				],
				'expectedSucceeded' => false
			],
			10 => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 42,
				'errorMessages'     => [
					"The value '42' exceeds the maximum flag value of '7'.",
				],
				'expectedSucceeded' => false
			],
			11 => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => '42',
				'errorMessages'     => [
					"The value '42' exceeds the maximum flag value of '7'.",
				],
				'expectedSucceeded' => false
			],
			12 => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'FLAG_A|42',
				'errorMessages'     => [
					"The value '42' exceeds the maximum flag value of '7'.",
				],
				'expectedSucceeded' => false
			],
			13 => [
				'valueValidator'    => new ValueValidator(),
				'flagableClassName' => new ValidFlagable(),
				'reflectedFlags'    => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maxValue'          => 7,
				'value'             => 'FLAG_A|-42|FLAG_D',
				'errorMessages'     => [
					"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidFlagable' expected.",
					"The value 'FLAG_D' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			]
		];
	}

	/**
	 * Tests if the flagable validator is working as expected.
	 * @param ValueValidatorInterface $valueValidator The validator implementing `ValueValidatorInterface`.
	 * @param FlagableInterface $flagable The flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable.
	 * @param int $maxValue The maximum value of the flagable.
	 * @param mixed $value The value to validate.
	 * @param array $errorMessages The error messages of the validation.
	 * @param bool $expectedSucceeded The success state of the validation.
	 * @dataProvider valuesAndResultsDataProvider
	 */
	public function testValueValidatorsValidateAndReturnValidationResultsCorrectly( ValueValidatorInterface $valueValidator, FlagableInterface $flagable, array $reflectedFlags, int $maxValue, $value, array $errorMessages, bool $expectedSucceeded ): void
	{
		$valueValidator->validate( $flagable, $reflectedFlags, $maxValue, $value );

		$resultedErrorMessages = $valueValidator->getErrorMessages();
		$resultedSucceeded     = $valueValidator->succeeded();

		static::assertEquals( $errorMessages, $resultedErrorMessages );
		static::assertEquals( $expectedSucceeded, $resultedSucceeded );
	}
}
