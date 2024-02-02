<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithExpectedFlagablesDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithExpectedIntegerRepresentationDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithExpectedStringRepresentationDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithUndefinedStaticMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithValidValueToCheckAndExpectedReturnValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithValidValueToSetAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithValidValueToSwitchAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest\ValidFlagablesWithValidValueToUnsetAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use CodeKandis\Types\MethodNotFoundExceptionInterface;
use CodeKandis\Types\PropertyNotFoundExceptionInterface;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Throwable;
use function iterator_to_array;

/**
 * Represents the test case of `CodeKandis\Phlags\FlagableInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableInterfaceTest extends TestCase
{
	/**
	 * Tests if calling `unset()` on an undefined member throws a `CodeKandis\Types\PropertyNotFoundExceptionInterface`.
	 * @param AbstractFlagable $validFlagable The valid flagable to test.
	 * @param string $undefinedMemberName The name of the undefined member to unset.
	 * @param string $expectedThrowableClassName The expected throwable class name.
	 * @param string $expectedThrowableMessage The expected throwable message.
	 */
	#[DataProviderExternal( ValidFlagablesWithUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfCallingUnsetOnUndefinedMemberThrowsPropertyNotFoundExceptionInterface( AbstractFlagable $validFlagable, string $undefinedMemberName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			unset( $validFlagable->{$undefinedMemberName} );
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( PropertyNotFoundExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if getting the value of an undefined member throws a `CodeKandis\Types\PropertyNotFoundExceptionInterface`.
	 * @param AbstractFlagable $validFlagable The valid flagable to test.
	 * @param string $undefinedMemberName The name of the undefined member to get its value.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfGettingTheValueOfUndefinedMemberThrowsPropertyNotFoundExceptionInterface( AbstractFlagable $validFlagable, string $undefinedMemberName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->{$undefinedMemberName};
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( PropertyNotFoundExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if getting the value of an undefined member throws a `CodeKandis\Types\PropertyNotFoundExceptionInterface`.
	 * @param AbstractFlagable $validFlagable The valid flagable to test.
	 * @param string $undefinedMemberName The name of the undefined member to set its value.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfSettingTheValueOfUndefinedMemberThrowsPropertyNotFoundExceptionInterface( AbstractFlagable $validFlagable, string $undefinedMemberName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->{$undefinedMemberName} = null;
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( PropertyNotFoundExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if calling an undefined method throws a `CodeKandis\Types\MethodNotFoundExceptionInterface`.
	 * @param AbstractFlagable $validFlagable The valid flagable to test.
	 * @param string $undefinedMethodName The name of the undefined method to call.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfCallingUndefinedMethodThrowsMethodNotFoundExceptionInterface( AbstractFlagable $validFlagable, string $undefinedMethodName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->{$undefinedMethodName}();
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( MethodNotFoundExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if accessing an undefined static method throws a `CodeKandis\Types\MethodNotFoundExceptionInterface`.
	 * @param AbstractFlagable $validFlagable The valid flagable to test.
	 * @param string $undefinedStaticMethodName The name of the undefined static method to call.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithUndefinedStaticMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfCallingUndefinedStaticMethodThrowsMethodNotFoundExceptionInterface( AbstractFlagable $validFlagable, string $undefinedStaticMethodName, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable::{$undefinedStaticMethodName}();
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( MethodNotFoundExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the method `FlagableInterface::__toString()` returns string representation correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param string $expectedStringRepresentation The expected string representation.
	 */
	#[DataProviderExternal( ValidFlagablesWithExpectedStringRepresentationDataProvider::class, 'provideData' )]
	public function testIfMethodToStringReturnsStringRepresentationCorrectly( FlagableInterface $validFlagable, string $expectedStringRepresentation ): void
	{
		$resultedStringRepresentation = (string) $validFlagable;

		static::assertSame( $expectedStringRepresentation, $resultedStringRepresentation );
	}

	/**
	 * Tests if the method `FlagableInterface::__invoke()` returns the integer representation correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int $expectedIntegerRepresentation The expected integer representation.
	 */
	#[DataProviderExternal( ValidFlagablesWithExpectedIntegerRepresentationDataProvider::class, 'provideData' )]
	public function testIfMethodInvokeReturnsIntegerRepresentationCorrectly( FlagableInterface $validFlagable, int $expectedIntegerRepresentation ): void
	{
		$resultedIntegerRepresentation = $validFlagable();

		static::assertSame( $expectedIntegerRepresentation, $resultedIntegerRepresentation );
	}

	/**
	 * Tests if the method `FlagableInterface::getValue()` returns the integer representation correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int $expectedIntegerRepresentation The expected integer representation.
	 */
	#[DataProviderExternal( ValidFlagablesWithExpectedIntegerRepresentationDataProvider::class, 'provideData' )]
	public function testIfMethodGetValueReturnsIntegerRepresentationCorrectly( FlagableInterface $validFlagable, int $expectedIntegerRepresentation ): void
	{
		$resultedIntegerRepresentation = $validFlagable->getValue();

		static::assertSame( $expectedIntegerRepresentation, $resultedIntegerRepresentation );
	}

	/**
	 * Tests if the method `FlagableInterface::has()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodHasThrowsInvalidValueExceptionOnInvalidValue( FlagableInterface $validFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->has( $invalidValue );
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidValueExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the method `FlagableInterface::has()` with a valid value returns the result correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $validValueToCheck The valid value to pass.
	 * @param bool $expectedReturnValue The expected return value.
	 */
	#[DataProviderExternal( ValidFlagablesWithValidValueToCheckAndExpectedReturnValueDataProvider::class, 'provideData' )]
	public function testIfMethodHasReturnsResultCorrectly( FlagableInterface $validFlagable, int|string|FlagableInterface $validValueToCheck, bool $expectedReturnValue ): void
	{
		$resultedReturnValue = $validFlagable->has( $validValueToCheck );

		static::assertSame( $expectedReturnValue, $resultedReturnValue );
	}

	/**
	 * Tests if the method `FlagableInterface::set()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodSetThrowsInvalidValueExceptionOnInvalidValue( FlagableInterface $validFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->set( $invalidValue );
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidValueExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the method `FlagableInterface::set()` sets the valid value correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $validValueToSet The valid value to pass.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidFlagablesWithValidValueToSetAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodSetSetsValueCorrectly( FlagableInterface $validFlagable, int|string|FlagableInterface $validValueToSet, int $expectedFlagValue ): void
	{
		$validFlagable->set( $validValueToSet );
		$resultedFlagValue = $validFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Tests if the method `FlagableInterface::unset()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodUnsetThrowsInvalidValueExceptionOnInvalidValue( FlagableInterface $validFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->unset( $invalidValue );
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidValueExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the method `FlagableInterface::unset()` unsets the valid value correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $validValueToUnset The valid value to unset.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidFlagablesWithValidValueToUnsetAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodUnsetUnsetsValueCorrectly( FlagableInterface $validFlagable, int|string|FlagableInterface $validValueToUnset, int $expectedFlagValue ): void
	{
		$validFlagable->unset( $validValueToUnset );
		$resultedFlagValue = $validFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Tests if the method `FlagableInterface::switch()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodSwitchThrowsInvalidValueExceptionOnInvalidValue( FlagableInterface $validFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validFlagable->switch( $invalidValue );
		}
		catch ( Throwable $throwable )
		{
			static::assertInstanceOf( InvalidValueExceptionInterface::class, $throwable );
			static::assertInstanceOf( $expectedThrowableClassName, $throwable );
			static::assertSame(
				$expectedThrowableMessage,
				$throwable->getMessage()
			);
		}
	}

	/**
	 * Tests if the method `FlagableInterface::switch()` switches the valid value correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param int|string|FlagableInterface $validValueToSwitch The valid value to switch.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidFlagablesWithValidValueToSwitchAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodSwitchSwitchesValueCorrectly( FlagableInterface $validFlagable, int|string|FlagableInterface $validValueToSwitch, int $expectedFlagValue ): void
	{
		$validFlagable->switch( $validValueToSwitch );
		$resultedFlagValue = $validFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Tests if the method `FlagableInterface::getIterator()` returns a list of all set flags correctly.
	 * @param FlagableInterface $validFlagable The valid flagable to test.
	 * @param FlagableInterface[] $expectedFlagables The list of expected flagables.
	 */
	#[DataProviderExternal( ValidFlagablesWithExpectedFlagablesDataProvider::class, 'provideData' )]
	public function testIfMethodGetIteratorReturnsListOfAllSetFlagsCorrectly( FlagableInterface $validFlagable, array $expectedFlagables ): void
	{
		$resultedFlagables = iterator_to_array(
			$validFlagable->getIterator(),
			false
		);

		static::assertEquals( $expectedFlagables, $resultedFlagables );
	}
}
