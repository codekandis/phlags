<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationExtensionTest\ValidConditionalManipulationFlagablesWithValidConditionalSetValuesValidConditionalSwitchValuesValidConditionalUnsetValuesAndExpectedFlagValuesDataProvider;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface;
use CodeKandis\PhpUnit\TestCase;
use PHPUnit\Framework\Attributes\DataProviderExternal;

/**
 * Represents the test case of `CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationExtension`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ConditionalManipulationExtensionTest extends TestCase
{
	/**
	 * Tests if the methods `ConditionalManipulationInterface::if*()` manipulate the values on conditions correctly.
	 * @param ConditionalManipulationInterface $validConditionalManipulationFlagable The valid conditional manipulation flagable.
	 * @param int|string|FlagableInterface $validSetValue_1 The first valid set value to pass.
	 * @param bool $setCondition_1 The first set condition to pass.
	 * @param int|string|FlagableInterface $validSetValue_2 The second valid set value to pass.
	 * @param bool $setCondition_2 The second set condition to pass.
	 * @param int|string|FlagableInterface $validSetValue_3 The third valid set value to pass.
	 * @param bool $setCondition_3 The third set condition to pass.
	 * @param int|string|FlagableInterface $validSetValue_4 The fourth valid set value to pass.
	 * @param bool $setCondition_4 The fourth set condition to pass.
	 * @param int|string|FlagableInterface $validSetValue_5 The fifth valid set value to pass.
	 * @param bool $setCondition_5 The fifth set condition to pass.
	 * @param int|string|FlagableInterface $validSwitchValue_1 The first valid switch value to pass.
	 * @param bool $switchCondition_1 The first switch condition to pass.
	 * @param int|string|FlagableInterface $validSwitchValue_2 The second valid switch value to pass.
	 * @param bool $switchCondition_2 The second switch condition to pass.
	 * @param int|string|FlagableInterface $validUnsetValue_1 The first valid unset value to pass.
	 * @param bool $unsetCondition_1 The first unset condition to pass.
	 * @param int|string|FlagableInterface $validUnsetValue_2 The second valid unset value to pass.
	 * @param bool $unsetCondition_2 The second unset condition to pass.
	 * @param int $expectedFlagValue_1 The expected flag value after the first set.
	 * @param int $expectedFlagValue_2 The expected flag value after the second set.
	 * @param int $expectedFlagValue_3 The expected flag value after the third set.
	 * @param int $expectedFlagValue_4 The expected flag value after the fourth set.
	 * @param int $expectedFlagValue_5 The expected flag value after the fifth set.
	 * @param int $expectedFlagValue_6 The expected flag value after the first switch.
	 * @param int $expectedFlagValue_7 The expected flag value after the second switch.
	 * @param int $expectedFlagValue_8 The expected flag value after the first unset.
	 * @param int $expectedFlagValue_9 The expected flag value after the second unset.
	 */
	#[DataProviderExternal( ValidConditionalManipulationFlagablesWithValidConditionalSetValuesValidConditionalSwitchValuesValidConditionalUnsetValuesAndExpectedFlagValuesDataProvider::class, 'provideData' )]
	public function testIfMethodsIfManipulateValuesOnConditionsCorrectly( ConditionalManipulationInterface $validConditionalManipulationFlagable, int|string|FlagableInterface $validSetValue_1, bool $setCondition_1, int|string|FlagableInterface $validSetValue_2, bool $setCondition_2, int|string|FlagableInterface $validSetValue_3, bool $setCondition_3, int|string|FlagableInterface $validSetValue_4, bool $setCondition_4, int|string|FlagableInterface $validSetValue_5, bool $setCondition_5, int|string|FlagableInterface $validSwitchValue_1, bool $switchCondition_1, int|string|FlagableInterface $validSwitchValue_2, bool $switchCondition_2, int|string|FlagableInterface $validUnsetValue_1, bool $unsetCondition_1, int|string|FlagableInterface $validUnsetValue_2, bool $unsetCondition_2, int $expectedFlagValue_1, int $expectedFlagValue_2, int $expectedFlagValue_3, int $expectedFlagValue_4, int $expectedFlagValue_5, int $expectedFlagValue_6, int $expectedFlagValue_7, int $expectedFlagValue_8, int $expectedFlagValue_9 ): void
	{
		$validConditionalManipulationFlagable->ifSet( $validSetValue_1, $setCondition_1 );

		static::assertEquals(
			$expectedFlagValue_1,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSet( $validSetValue_2, $setCondition_2 );

		static::assertEquals(
			$expectedFlagValue_2,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSet( $validSetValue_3, $setCondition_3 );

		static::assertEquals(
			$expectedFlagValue_3,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSet( $validSetValue_4, $setCondition_4 );

		static::assertEquals(
			$expectedFlagValue_4,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSet( $validSetValue_5, $setCondition_5 );

		static::assertEquals(
			$expectedFlagValue_5,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSwitch( $validSwitchValue_1, $switchCondition_1 );

		static::assertEquals(
			$expectedFlagValue_6,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifSwitch( $validSwitchValue_2, $switchCondition_2 );

		static::assertEquals(
			$expectedFlagValue_7,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifUnset( $validUnsetValue_1, $unsetCondition_1 );

		static::assertEquals(
			$expectedFlagValue_8,
			$validConditionalManipulationFlagable->getValue()
		);

		$validConditionalManipulationFlagable->ifUnset( $validUnsetValue_2, $unsetCondition_2 );

		static::assertEquals(
			$expectedFlagValue_9,
			$validConditionalManipulationFlagable->getValue()
		);
	}
}
