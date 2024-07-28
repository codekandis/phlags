<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\FlagableStateInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest\FlagableStatesWithMaximumFlagValueAndExpectedMaximumFlagValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest\FlagableStatesWithReflectedFlagsAndExpectedReflectedFlagsDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest\FlagableStatesWithValidationThrowableAndExpectedValidationThrowableDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest\FlagableStatesWithValidationStateAndExpectedValidationStateDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest\FlagableStatesWithValueValidatorAndExpectedValueValidatorDataProvider;
use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\FlagableStateInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStateInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `FlagableStateInterface::setHasBeenValidated()" sets the validation state correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param bool $validationState The validation state to set.
	 * @param bool $expectedValidationState The expected validation state.
	 */
	#[DataProviderExternal( FlagableStatesWithValidationStateAndExpectedValidationStateDataProvider::class, 'provideData' )]
	public function testIfMethodSetHasBeenValidatedSetsValidationStateCorrectly( FlagableStateInterface $flagableState, bool $validationState, bool $expectedValidationState ): void
	{
		$flagableState->setHasBeenValidated( $validationState );
		$resultedValidationState = $flagableState->getHasBeenValidated();

		static::assertSame( $expectedValidationState, $resultedValidationState );
	}

	/**
	 * Tests if the method `FlagableStateInterface::setValidationException()" sets the validation throwable correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param ?InvalidFlagableExceptionInterface $validationThrowable The validation throwable to set.
	 * @param ?InvalidFlagableExceptionInterface $expectedValidationThrowable The expected validation throwable.
	 */
	#[DataProviderExternal( FlagableStatesWithValidationThrowableAndExpectedValidationThrowableDataProvider::class, 'provideData' )]
	public function testIfMethodSetValidationThrowableSetsValidationThrowableCorrectly( FlagableStateInterface $flagableState, ?InvalidFlagableExceptionInterface $validationThrowable, ?InvalidFlagableExceptionInterface $expectedValidationThrowable ): void
	{
		$flagableState->setValidationException( $validationThrowable );
		$resultedValidationThrowable = $flagableState->getValidationException();

		static::assertSame( $expectedValidationThrowable, $resultedValidationThrowable );
	}

	/**
	 * Tests if the method `FlagableStateInterface::setReflectedFlags()" sets the reflected flags correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param ?<string,int>[] $reflectedFlags The reflected flags to set.
	 * @param ?<string,int>[] $expectedReflectedFlags The expected reflected flags.
	 */
	#[DataProviderExternal( FlagableStatesWithReflectedFlagsAndExpectedReflectedFlagsDataProvider::class, 'provideData' )]
	public function testIfMethodSetReflectedFlagsSetsReflectedFlagsCorrectly( FlagableStateInterface $flagableState, ?array $reflectedFlags, ?array $expectedReflectedFlags ): void
	{
		$flagableState->setReflectedFlags( $reflectedFlags );
		$resultedReflectedFlags = $flagableState->getReflectedFlags();

		static::assertSame( $expectedReflectedFlags, $resultedReflectedFlags );
	}

	/**
	 * Tests if the method `FlagableStateInterface::setMeximumValue()" sets the maximum value correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param int $maximumFlagValue The maximum flag value to set.
	 * @param int $expectedMaximumFlagValue The expected maximum flag value.
	 */
	#[DataProviderExternal( FlagableStatesWithMaximumFlagValueAndExpectedMaximumFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodSetMaximumValueSetsMaximumValueCorrectly( FlagableStateInterface $flagableState, int $maximumFlagValue, int $expectedMaximumFlagValue ): void
	{
		$flagableState->setMaximumValue( $maximumFlagValue );
		$resultedMaximumFlagValue = $flagableState->getMaximumValue();

		static::assertSame( $expectedMaximumFlagValue, $resultedMaximumFlagValue );
	}

	/**
	 * Tests if the method `FlagableStateInterface::setValueValidator()" sets the valueValidator correctly.
	 * @param FlagableStateInterface $flagableState The flagable state to test.
	 * @param ?ValueValidatorInterface $valueValidator The value validator to set.
	 * @param ?ValueValidatorInterface $expectedValueValidator The expected value validator.
	 */
	#[DataProviderExternal( FlagableStatesWithValueValidatorAndExpectedValueValidatorDataProvider::class, 'provideData' )]
	public function testIfMethodSetValueValidatorSetsValueValidatorCorrectly( FlagableStateInterface $flagableState, ?ValueValidatorInterface $valueValidator, ?ValueValidatorInterface $expectedValueValidator ): void
	{
		$flagableState->setValueValidator( $valueValidator );
		$resultedValueValidator = $flagableState->getValueValidator();

		static::assertSame( $expectedValueValidator, $resultedValueValidator );
	}
}
