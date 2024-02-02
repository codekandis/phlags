<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest\ValidConditionalManipulationFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest\ValidConditionalManipulationFlagablesWithValidSetValueSetConditionAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest\ValidConditionalManipulationFlagablesWithValidSwitchValueSwitchConditionAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest\ValidConditionalManipulationFlagablesWithValidUnsetValueUnsetConditionAndExpectedFlagValueDataProvider;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Throwable;

/**
 * Represents the test case of `CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ConditionalManipulationInterfaceTest extends TestCase
{
	/**
	 * Tests if the method `ConditionalManipulationInterface::ifSet()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodSetThrowsInvalidValueExceptionOnInvalidValue( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validConditionalManipulationFlagable->set( $invalidValue );
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
	 * Tests if the method `ConditionalManipulationInterface::ifSet()` sets the value on condition correctly.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $validSetValue The valid set value to pass
	 * @param bool $setCondition The set condition to pass.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithValidSetValueSetConditionAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodIfSetSetsValueOnConditionCorrectly( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $validSetValue, bool $setCondition, int $expectedFlagValue ): void
	{
		$validConditionalManipulationFlagable->ifSet( $validSetValue, $setCondition );
		$resultedFlagValue = $validConditionalManipulationFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Tests if the method `ConditionalManipulationInterface::ifUnset()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodUnsetThrowsInvalidValueExceptionOnInvalidValue( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validConditionalManipulationFlagable->unset( $invalidValue );
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
	 * Tests if the method `ConditionalManipulationInterface::ifUnset()` unsets the value on condition correctly.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $validUnsetValue The valid unset value to pass
	 * @param bool $unsetCondition The unset condition to pass.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithValidUnsetValueUnsetConditionAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodIfUnsetUnsetsValueOnConditionCorrectly( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $validUnsetValue, bool $unsetCondition, int $expectedFlagValue ): void
	{
		$validConditionalManipulationFlagable->ifUnset( $validUnsetValue, $unsetCondition );
		$resultedFlagValue = $validConditionalManipulationFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Tests if the method `ConditionalManipulationInterface::ifSwitch()` throws a `CodeKandis\Phlags\InvalidValueExceptionInterface` if a value is invalid.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $invalidValue The invalid value to pass.
	 * @param string $expectedThrowableClassName The class name of the expected throwable.
	 * @param string $expectedThrowableMessage The message of the expected throwable.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider::class, 'provideData' )]
	public function testIfMethodSwitchThrowsInvalidValueExceptionOnInvalidValue( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $invalidValue, string $expectedThrowableClassName, string $expectedThrowableMessage ): void
	{
		try
		{
			$validConditionalManipulationFlagable->switch( $invalidValue );
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
	 * Tests if the method `ConditionalManipulationInterface::ifSwitch()` switches the value on condition correctly.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable to test.
	 * @param int|string|FlagableInterface $validSwitchValue The valid switch value to pass
	 * @param bool $switchCondition The switch condition to pass.
	 * @param int $expectedFlagValue The expected flag value.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithValidSwitchValueSwitchConditionAndExpectedFlagValueDataProvider::class, 'provideData' )]
	public function testIfMethodIfSwitchSwitchesValueOnConditionCorrectly( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $validSwitchValue, bool $switchCondition, int $expectedFlagValue ): void
	{
		$validConditionalManipulationFlagable->ifSwitch( $validSwitchValue, $switchCondition );
		$resultedFlagValue = $validConditionalManipulationFlagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}
}
