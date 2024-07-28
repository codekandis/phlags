<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\AbstractFlagableTest\InvalidFlagableClassNamesWithExpectedThrowableClassNameAndExpectedThrowableMessage;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\AbstractFlagableTest\ValidFlagableClassNamesWithInitialValueAndExpectedFlagValue;
use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Throwable;

/**
 * Represents the test case of `CodeKandis\Phlags\AbstractFlagable`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class AbstractFlagableTest extends TestCase
{
	/**
	 * Tests if an throwable will be thrown while instantiating an invalid flagable.
	 * @param string $invalidFlagableClassName The class name of the invalid flagable to test.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( InvalidFlagableClassNamesWithExpectedThrowableClassNameAndExpectedThrowableMessage::class, 'provideData' )]
	public function testIfInstantiationOfInvalidFlagableThrowsInvalidFlagableExceptionInterface( string $invalidFlagableClassName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			new $invalidFlagableClassName();
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidFlagableExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the stored throwable will be thrown repeatedly while instantiating an invalid flagable.
	 * @param string $invalidFlagableClassName The class name of the invalid flagable to test.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( InvalidFlagableClassNamesWithExpectedThrowableClassNameAndExpectedThrowableMessage::class, 'provideData' )]
	public function testIfRepeatedInstantiationOfInvalidFlagableThrowsStoredInvalidFlagableExceptionInterface( string $invalidFlagableClassName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		$resultedFirstThrowable = null;
		try
		{
			new $invalidFlagableClassName();
		}
		catch ( Throwable $throwable )
		{
			$resultedFirstThrowable = $throwable;
		}

		try
		{
			new $invalidFlagableClassName();
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidFlagableExceptionInterface::class, $resultedFirstThrowable );
			static::assertInstanceOf( $expectedThrowableClassName, $resultedFirstThrowable );
			static::assertSame(
				$expectedThrowableMessage,
				$resultedFirstThrowable->getMessage()
			);
			static::assertSame( $resultedFirstThrowable, $throwable );
		}
	}

	/**
	 * Tests if the method `AbstractFlagable::getValue()` returns the initial value correctly.
	 * @param string $validFlagableClassName The class name of the valid flagable to test.
	 * @param int|string|FlagableInterface $initialValue The initial flag value.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidFlagableClassNamesWithInitialValueAndExpectedFlagValue::class, 'provideData' )]
	public function testIfMethodGetValueReturnsInitialValueCorrectly( string $validFlagableClassName, int|string|FlagableInterface $initialValue, int $expectedFlagValue ): void
	{
		/**
		 * @var AbstractFlagable $flagable
		 */
		$flagable          = new $validFlagableClassName( $initialValue );
		$returnedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $returnedFlagValue );
	}
}
