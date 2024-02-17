<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\ValidatorInterfaceTest\ValidatorsWithExpectedSucceededAndExpectedErrorMessagesDataProvider;
use CodeKandis\Phlags\Validation\ValidatorInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\Validation\ValidatorInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidatorInterfaceTest extends TestCase
{
	/**
	 * Tests if the methods `ValidatorInterface::succeeded()` and `ValidatorInterface::getErrorMessage()` return results correctly.
	 * @param ValidatorInterface $validator The validator to test.
	 * @param bool $expectedSucceeded The expected succeeded state of the validation.
	 * @param string[] $expectedErrorMessages The expected error messages of the validation.
	 */
	#[DataProviderExternal( ValidatorsWithExpectedSucceededAndExpectedErrorMessagesDataProvider::class, 'provideData' )]
	public function testIfMethodsSucceededAndGetErrorMessagesReturnResultsCorrectly( ValidatorInterface $validator, bool $expectedSucceeded, array $expectedErrorMessages ): void
	{
		$resultedSucceeded     = $validator->succeeded();
		$resultedErrorMessages = $validator->getErrorMessages();

		static::assertSame( $expectedSucceeded, $resultedSucceeded );
		static::assertSame( $expectedErrorMessages, $resultedErrorMessages );
	}
}
