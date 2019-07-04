<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Exceptions;

use CodeKandis\Phlags\Exceptions\ErrorMessagesExceptionInterface;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\InvalidValueException;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\Exceptions\ErrorMessagesExceptionInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ErrorMessagesExceptionInterfaceTest extends TestCase
{
	/**
	 * Provides exceptions implementing `ErrorMessagesExceptionInterface` with error messages.
	 * @return array The exceptions implementing `ErrorMessagesExceptionInterface` with error messages.
	 */
	public function errorMessagesExceptionsWithMessagesDataProvider(): array
	{
		return [
			0 => [
				'exception'     => new InvalidFlagableException(),
				'errorMessages' => [
					'foo',
					'bar'
				]
			],
			1 => [
				'exception'     => new InvalidFlagableException(),
				'errorMessages' => []
			],
			2 => [
				'exception'     => new InvalidValueException(),
				'errorMessages' => [
					'foo',
					'bar'
				]
			],
			3 => [
				'exception'     => new InvalidValueException(),
				'errorMessages' => []
			]
		];
	}

	/**
	 * Tests if the passed error messages are returned correctly.
	 * @param ErrorMessagesExceptionInterface $exceptionInstance The exception implementing `ErrorMessagesExceptionInterface`.
	 * @param array $errorMessages The error messages to pass.
	 * @dataProvider errorMessagesExceptionsWithMessagesDataProvider
	 */
	public function testErrorMessagesAreStoredAndReturnedCorrectly( ErrorMessagesExceptionInterface $exceptionInstance, array $errorMessages ): void
	{
		$exceptionInstance->withErrorMessages( $errorMessages );

		$returnedErrorMessages = $exceptionInstance->getErrorMessages();

		static::assertSame( $errorMessages, $returnedErrorMessages );
	}
}
