<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\InvalidValueExceptionInterfaceTest\ThrowableClassNamesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\Validation\InvalidValueExceptionInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidValueExceptionInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `InvalidValueExceptionInterface::with_value()` instantiates the throwable correctly.
	 * @param string $throwableClassName The class name of the throwable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ThrowableClassNamesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodWithInvalidValueInstantiatesThrowableCorrectly( string $throwableClassName, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedThrowable          = $throwableClassName::{'with_invalidValue'}( $invalidValue );
		$resultedThrowableClassName = $resultedThrowable::class;
		$resultedThrowableMessage   = $resultedThrowable->getMessage();

		static::assertInstanceOf( InvalidValueExceptionInterface::class, $resultedThrowable );
		static::assertSame( $expectedThrowableClassName, $resultedThrowableClassName );
		static::assertSame( $expectedThrowableMessage, $resultedThrowableMessage );
	}
}
