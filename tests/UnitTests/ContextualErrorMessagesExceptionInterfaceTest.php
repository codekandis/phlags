<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\ContextualErrorMessagesExceptionInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\ContextualErrorMessagesExceptionInterfaceTest\ThrowablesWithContextErrorMessagesDataProvider;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\ContextualErrorMessagesExceptionInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ContextualErrorMessagesExceptionInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `ContextualErrorMessagesExceptionInterface::setContextErrorMessages()` sets context error messages correctly.
	 * @param ContextualErrorMessagesExceptionInterface $throwable The throwable implementing `ContextualErrorMessagesExceptionInterface`.
	 * @param string[] $contextErrorMessages The context error messages to pass.
	 * @param string[] $expectedContextErrorMessages The expected context error messages.
	 */
	#[DataProviderExternal( ThrowablesWithContextErrorMessagesDataProvider::class, 'provideData' )]
	public function testIfMethodSetContextErrorMessagesSetsAreStoredContextErrorMessagesCorrectly( ContextualErrorMessagesExceptionInterface $throwable, array $contextErrorMessages, array $expectedContextErrorMessages ): void
	{
		$throwable->setContextErrorMessages( ...$contextErrorMessages );
		$returnedContextErrorMessages = $throwable->getContextErrorMessages();

		static::assertSame( $expectedContextErrorMessages, $returnedContextErrorMessages );
	}
}
