<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\FlagableValidatorInterfaceTest\FlagableValidatorsWithFlagableClassNameReflectedFlagsExpectedSucceecedStateExpectedMaximumFlagValueAndExpectedErrorMessagesDataProvider;
use CodeKandis\Phlags\Validation\FlagableValidatorInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\Validation\FlagableValidatorInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidatorInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `FlagableValidatorInterface::validate()` validates and the methods `FlagableValidatorInterface::succeeded()`, `FlagableValidatorInterface::getMaximumValue()`, `FlagableValidatorInterface::getErrorMessages()` return results correctly.
	 * @param FlagableValidatorInterface $flagableValidator The flagable validator to test.
	 * @param string $flagableClassName The class name of the flagable to pass.
	 * @param <string,int>[] $reflectedFlags The reflected flags to pass.
	 * @param bool $expectedSucceededState The expected succeeded state.
	 * @param int $expectedMaximumFlagValue The expected maximum flag value.
	 * @param string[] $expectedErrorMessages The expected error messages.
	 */
	#[DataProviderExternal( FlagableValidatorsWithFlagableClassNameReflectedFlagsExpectedSucceecedStateExpectedMaximumFlagValueAndExpectedErrorMessagesDataProvider::class, 'provideData' )]
	public function testIfMethodValidateValidatesAndMethodsSucceededGetMaximumValueAndGetErrorMessagesReturnResultsCorrectly( FlagableValidatorInterface $flagableValidator, string $flagableClassName, array $reflectedFlags, bool $expectedSucceededState, int $expectedMaximumFlagValue, array $expectedErrorMessages ): void
	{
		$flagableValidator->validate( $flagableClassName, $reflectedFlags );
		$resultedSucceeded        = $flagableValidator->succeeded();
		$resultedMaximumFlagValue = $flagableValidator->getMaximumValue();
		$resultedErrorMessages    = $flagableValidator->getErrorMessages();

		static::assertEquals( $expectedMaximumFlagValue, $resultedMaximumFlagValue );
		static::assertEquals( $expectedSucceededState, $resultedSucceeded );
		static::assertEquals( $expectedErrorMessages, $resultedErrorMessages );
	}
}
