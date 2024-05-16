<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\InvalidFlagableExceptionInterfaceTest\ThrowableClassNamesWithInvalidFlagableClassNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableExceptionInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `InvalidFlagableExceptionInterface::with_flagableFqn()` instantiates the throwable correctly.
	 * @param string $throwableClassName The class name of the throwable to test.
	 * @param string $invalidFlagableClassName The class name of the invalid flagable to pass.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ThrowableClassNamesWithInvalidFlagableClassNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodWithInvalidFlagableClassNameInstantiatesThrowableCorrectly( string $throwableClassName, string $invalidFlagableClassName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedThrowable          = $throwableClassName::{'with_invalidFlagableClassName'}( $invalidFlagableClassName );
		$resultedThrowableClassName = $resultedThrowable::class;
		$resultedThrowableMessage   = $resultedThrowable->getMessage();

		static::assertInstanceOf( InvalidFlagableExceptionInterface::class, $resultedThrowable );
		static::assertSame( $expectedThrowableClassName, $resultedThrowableClassName );
		static::assertSame( $expectedThrowableMessage, $resultedThrowableMessage );
	}
}
