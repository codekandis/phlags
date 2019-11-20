<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\Phlags\FlagableStateInterface;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\FlagableStateInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStateInterfaceTest extends TestCase
{
	/**
	 * Provides flagable states implementing `FlagableStateInterface` with validation states.
	 * @return array The flagable states implementing `FlagableStateInterface` with validation states.
	 */
	public function flagableStatesWithValidationStateDataProvider(): array
	{
		return [
			0 => [
				'flagableState'   => new FlagableState(),
				'validationState' => false
			],
			1 => [
				'flagableState'   => new FlagableState(),
				'validationState' => true
			]
		];
	}

	/**
	 * Tests if the validation state is stored and returned correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param bool $validationState The validation state to store.
	 * @dataProvider flagableStatesWithValidationStateDataProvider
	 */
	public function testHasBeenValidatedWillBeStoredAndReturnedCorrectly( FlagableStateInterface $flagableState, bool $validationState ): void
	{
		$flagableState->setHasBeenValidated( $validationState );
		$resultedValidationState = $flagableState->getHasBeenValidated();

		static::assertSame( $validationState, $resultedValidationState );
	}

	/**
	 * Provides flagable states implementing `FlagableStateInterface` with validation states.
	 * @return array The flagable states implementing `FlagableStateInterface` with validation states.
	 */
	public function flagableStatesWithValidationExceptionDataProvider(): array
	{
		return [
			0 => [
				'flagableState'       => new FlagableState(),
				'validationException' => null
			],
			1 => [
				'flagableState'       => new FlagableState(),
				'validationException' => new InvalidFlagableException()
			],
			2 => [
				'flagableState'       => new FlagableState(),
				'validationException' => new class() extends InvalidFlagableException
				{
				}
			]
		];
	}

	/**
	 * Tests if the validation exception is stored and returned correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param null|InvalidFlagableException $validationException The validation exception to store.
	 * @dataProvider flagableStatesWithValidationExceptionDataProvider
	 */
	public function testValidationExceptionWillBeStoredAndReturnedCorrectly( FlagableStateInterface $flagableState, ?InvalidFlagableException $validationException ): void
	{
		$flagableState->setValidationException( $validationException );
		$resultedValidationException = $flagableState->getValidationException();

		static::assertSame( $validationException, $resultedValidationException );
	}

	/**
	 * Provides flagable states implementing `FlagableStateInterface` with reflected values.
	 * @return array The flagable states implementing `FlagableStateInterface` with reflected values.
	 */
	public function flagableStatesWithReflectedValuesDataProvider(): array
	{
		return [
			0 => [
				'flagableState'   => new FlagableState(),
				'reflectedValues' => null
			],
			1 => [
				'flagableState'   => new FlagableState(),
				'reflectedValues' => [
					'FLAG_A'
				]
			],
			2 => [
				'flagableState'   => new FlagableState(),
				'reflectedValues' => [
					'FLAG_A',
					'FLAG_B'
				]
			],
			3 => [
				'flagableState'   => new FlagableState(),
				'reflectedValues' => [
					'FLAG_A',
					'FLAG_B',
					'FLAG_C'
				]
			],
			4 => [
				'flagableState'   => new FlagableState(),
				'reflectedValues' => [
					'FLAG_A',
					'FLAG_C'
				]
			]
		];
	}

	/**
	 * Tests if the reflected flags are stored and returned correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param null|array $reflectedFlags The reflected flags to store.
	 * @dataProvider flagableStatesWithReflectedValuesDataProvider
	 */
	public function testReflectedFlagsWillBeStoredAndReturnedCorrectly( FlagableStateInterface $flagableState, ?array $reflectedFlags ): void
	{
		$flagableState->setReflectedFlags( $reflectedFlags );
		$resultedReflectedFlags = $flagableState->getReflectedFlags();

		static::assertSame( $reflectedFlags, $resultedReflectedFlags );
	}

	/**
	 * Provides flagable states implementing `FlagableStateInterface` with max values.
	 * @return array The flagable states implementing `FlagableStateInterface` with max values.
	 */
	public function flagableStatesWithMaxValuesDataProvider(): array
	{
		return [
			0 => [
				'flagableState' => new FlagableState(),
				'maxValue'      => 0
			],
			1 => [
				'flagableState' => new FlagableState(),
				'maxValue'      => 1
			],
			2 => [
				'flagableState' => new FlagableState(),
				'maxValue'      => 2
			],
			3 => [
				'flagableState' => new FlagableState(),
				'maxValue'      => 4
			]
		];
	}

	/**
	 * Tests if the max value is stored and returned correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param int $maxValue The max value to store.
	 * @dataProvider flagableStatesWithMaxValuesDataProvider
	 */
	public function testMaxValueWillBeStoredAndReturnedCorrectly( FlagableStateInterface $flagableState, int $maxValue ): void
	{
		$flagableState->setMaxValue( $maxValue );
		$resultedMaxValue = $flagableState->getMaxValue();

		static::assertSame( $maxValue, $resultedMaxValue );
	}

	/**
	 * Provides flagable states implementing `FlagableStateInterface` with max values.
	 * @return array The flagable states implementing `FlagableStateInterface` with max values.
	 */
	public function flagableStatesWithValueValidatorsDataProvider(): array
	{
		return [
			0 => [
				'flagableState'  => new FlagableState(),
				'valueValidator' => null
			],
			1 => [
				'flagableState'  => new FlagableState(),
				'valueValidator' => new ValueValidator()
			],
			2 => [
				'flagableState'  => new FlagableState(),
				'valueValidator' => new class() extends ValueValidator
				{
				}
			]
		];
	}

	/**
	 * Tests if the value validator is stored and returned correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param null|ValueValidatorInterface $valueValidator The value validator to store.
	 * @dataProvider flagableStatesWithValueValidatorsDataProvider
	 */
	public function testValueValidatorWillBeStoredAndReturnedCorrectly( FlagableStateInterface $flagableState, ?ValueValidatorInterface $valueValidator ): void
	{
		$flagableState->setValueValidator( $valueValidator );
		$resultedValueValidator = $flagableState->getValueValidator();

		static::assertSame( $valueValidator, $resultedValueValidator );
	}
}
