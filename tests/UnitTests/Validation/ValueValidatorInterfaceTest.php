<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\ValueValidatorInterfaceTest\ValueValidatorsWithValidFlagableReflectedFlagsMaximumFlagValueValueExpectedSucceededAndExpectedErrorMessagesDataProvider;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\Validation\ValueValidatorInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValueValidatorInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `ValueValidatorInterface::validate()` validates and the methods `ValueValidatorInterface::succeeded()` and `ValueValidatorInterface::getErrorMessages()` return results correctly.
	 * @param ValueValidatorInterface $valueValidator The value validator to test.
	 * @param FlagableInterface $validFlagable The valid flagable to pass.
	 * @param <string,int>[] $reflectedFlags The reflected flags to pass.
	 * @param int $maximumFlagValue The maximum flag value to pass.
	 * @param mixed $value The value to pass.
	 * @param bool $expectedSucceeded The expected succeeded state.
	 * @param string[] $expectedErrorMessages The expected error messages.
	 */
	#[DataProviderExternal( ValueValidatorsWithValidFlagableReflectedFlagsMaximumFlagValueValueExpectedSucceededAndExpectedErrorMessagesDataProvider::class, 'provideData' )]
	public function testIfMethodValidateValidatesAndMethodsSucceededAndGetErrorMessagesReturnResultsCorrectly( ValueValidatorInterface $valueValidator, FlagableInterface $validFlagable, array $reflectedFlags, int $maximumFlagValue, mixed $value, bool $expectedSucceeded, array $expectedErrorMessages ): void
	{
		$valueValidator->validate( $validFlagable, $reflectedFlags, $maximumFlagValue, $value );
		$resultedSucceeded     = $valueValidator->succeeded();
		$resultedErrorMessages = $valueValidator->getErrorMessages();

		static::assertEquals( $expectedSucceeded, $resultedSucceeded );
		static::assertEquals( $expectedErrorMessages, $resultedErrorMessages );
	}
}
