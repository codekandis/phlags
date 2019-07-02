<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Exceptions;

use CodeKandis\Phlags\Exceptions\InvalidValueException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Exceptions\InvalidValueException'.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
final class InvalidValueExceptionTest extends TestCase
{
	/**
	 * Tests that provided error messages are stored and returned correctly.
	 * @param string[] $errorMessages The error messages of the exception.
	 * @dataProvider errorMessagesDataProvider
	 */
	public function testsErrorMessagesStoredCorrectly( array $errorMessages ): void
	{
		$exception = ( new InvalidValueException() )->withErrorMessages( $errorMessages );
		$this->assertEquals( $errorMessages, $exception->getErrorMessages() );
	}

	/**
	 * Provides data sets with error messages to the exception to test.
	 * @return array The data sets.
	 */
	public function errorMessagesDataProvider(): array
	{
		return [
			[
				'errorMessages' => [
					'foobar',
					'barfoo',
				],
			],
		];
	}
}
