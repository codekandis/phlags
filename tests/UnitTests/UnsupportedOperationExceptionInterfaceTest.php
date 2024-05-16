<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest\ThrowableClassNamesWithClassNameUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest\ThrowableClassNamesWithClassNameUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest\ThrowableClassNamesWithClassNameUndefinedStaticMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\UnsupportedOperationExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\UnsupportedOperationExceptionInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class UnsupportedOperationExceptionInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `UnsupportedOperationExceptionInterface::with_undefinedMemberName()` instantiates the throwable correctly.
	 * @param string $throwableClassName The class name of the throwable to test.
	 * @param string $className The class name to pass.
	 * @param string $undefinedMemberName The undefined member name to pass.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ThrowableClassNamesWithClassNameUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodWithUndefinedMemberNameInstantiatesThrowableCorrectly( string $throwableClassName, string $className, string $undefinedMemberName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedThrowable          = $throwableClassName::{'with_classNameAndUndefinedMemberName'}( $className, $undefinedMemberName );
		$resultedThrowableClassName = $resultedThrowable::class;
		$resultedThrowableMessage   = $resultedThrowable->getMessage();

		static::assertInstanceOf( UnsupportedOperationExceptionInterface::class, $resultedThrowable );
		static::assertSame( $expectedThrowableClassName, $resultedThrowableClassName );
		static::assertSame( $expectedThrowableMessage, $resultedThrowableMessage );
	}

	/**
	 * Tests if the method `UnsupportedOperationExceptionInterface::with_undefinedMethodName()` instantiates the throwable correctly.
	 * @param string $throwableClassName The class name of the throwable to test.
	 * @param string $className The class name to pass.
	 * @param string $undefinedMethodName The undefined method name to pass.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ThrowableClassNamesWithClassNameUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodWithUndefinedMethodNameInstantiatesThrowableCorrectly( string $throwableClassName, string $className, string $undefinedMethodName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedThrowable          = $throwableClassName::{'with_classNameAndUndefinedMethodName'}( $className, $undefinedMethodName );
		$resultedThrowableClassName = $resultedThrowable::class;
		$resultedThrowableMessage   = $resultedThrowable->getMessage();

		static::assertInstanceOf( UnsupportedOperationExceptionInterface::class, $resultedThrowable );
		static::assertSame( $expectedThrowableClassName, $resultedThrowableClassName );
		static::assertSame( $expectedThrowableMessage, $resultedThrowableMessage );
	}

	/**
	 * Tests if the method `UnsupportedOperationExceptionInterface::with_undefinedMethodName()` instantiates the throwable correctly.
	 * @param string $throwableClassName The class name of the throwable to test.
	 * @param string $className The class name to pass.
	 * @param string $undefinedStaticMethodName The undefined static method name to pass.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ThrowableClassNamesWithClassNameUndefinedStaticMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodWithUndefinedStaticMethodNameInstantiatesThrowableCorrectly( string $throwableClassName, string $className, string $undefinedStaticMethodName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedThrowable          = $throwableClassName::{'with_classNameAndUndefinedStaticMethodName'}( $className, $undefinedStaticMethodName );
		$resultedThrowableClassName = $resultedThrowable::class;
		$resultedThrowableMessage   = $resultedThrowable->getMessage();

		static::assertInstanceOf( UnsupportedOperationExceptionInterface::class, $resultedThrowable );
		static::assertSame( $expectedThrowableClassName, $resultedThrowableClassName );
		static::assertSame( $expectedThrowableMessage, $resultedThrowableMessage );
	}
}
