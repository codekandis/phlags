<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\Validation\InvalidFlagableException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Validation\InvalidFlagableException'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class InvalidFlagableExceptionTest extends TestCase
{
	/**
	 * Tests that provided error messages are stored and returned correctly.
	 * @param string[] $errorMessages The error messages of the exception.
	 * @dataProvider errorMessagesDataProvider
	 */
	public function testsErrorMessagesStoredCorrectly( array $errorMessages ): void
	{
		$exception = ( new InvalidFlagableException() )->withErrorMessages( $errorMessages );

		static::assertEquals( $errorMessages, $exception->getErrorMessages() );
	}

	/**
	 * Provides data sets with error messages to the exception to test.
	 * @return array The data sets.
	 */
	public function errorMessagesDataProvider(): array
	{
		return [
			0 => [
				'errorMessages' => [
					'foobar',
					'barfoo',
				],
			],
		];
	}
}
