<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ConditionalManipulatableFlagable;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class ConditionalManipulationInterfaceTest extends TestCase
{
	/**
	 * Provides initiated flagables with set values.
	 * @return array The initiated flagables with set values.
	 */
	public function initiatedConditionalFlagablesWithFlagsConditionsAndSetReturnValuesDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			1  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			2  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			3  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			4  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => '1',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			5  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => '1',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			6  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => 'FLAG_A',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			7  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => 'FLAG_A',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			8  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			9  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			10 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			11 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			12 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			13 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			14 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			15 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			16 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			17 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			]
		];
	}

	/**
	 * Tests if the passed value will be set correctly on condition while calling the method `ifSet()`.
	 * @param ConditionalManipulationInterface $flagable The conditional flagable to test.
	 * @param int|string|FlagableInterface $valueToSet The value to set.
	 * @param bool $condition true if the value can be set, false otherwise.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedConditionalFlagablesWithFlagsConditionsAndSetReturnValuesDataProvider
	 */
	public function testIfSetSetsFlagsOnConditionCorrectly( ConditionalManipulationInterface $flagable, $valueToSet, bool $condition, int $expectedFlagValue ): void
	{
		$flagable->ifSet( $valueToSet, $condition );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Provides initiated flagables with unset values.
	 * @return array The initiated flagables with unset values.
	 */
	public function initiatedConditionalFlagablesWithFlagsConditionsAndUnsetReturnValuesDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			1  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			2  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			3  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			4  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => '1',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			5  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => '1',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			6  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => 'FLAG_A',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			7  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToUnset'      => 'FLAG_A',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			8  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			9  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			10 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			11 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			12 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			13 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			14 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			15 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			16 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			17 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			]
		];
	}

	/**
	 * Tests if the passed value will be unset correctly on condition while calling the method `ifUnset()`.
	 * @param ConditionalManipulationInterface $flagable The conditional flagable to test.
	 * @param int|string|FlagableInterface $valueToUnset The value to unset.
	 * @param bool $condition true if the value can be unset, false otherwise.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedConditionalFlagablesWithFlagsConditionsAndUnsetReturnValuesDataProvider
	 */
	public function testIfUnsetSetsFlagsOnConditionCorrectly( ConditionalManipulationInterface $flagable, $valueToUnset, bool $condition, int $expectedFlagValue ): void
	{
		$flagable->ifUnset( $valueToUnset, $condition );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Provides initiated flagables with switch values.
	 * @return array The initiated flagables with switch values.
	 */
	public function initiatedConditionalFlagablesWithFlagsConditionsAndSwitchReturnValuesDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			1  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			2  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			3  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			4  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => '1',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			5  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => '1',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			6  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => 'FLAG_A',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::NONE
			],
			7  => [
				'flagable'          => new ConditionalManipulatableFlagable(),
				'valueToSet'        => 'FLAG_A',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			8  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_B,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			9  => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_B,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B
			],
			10 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			11 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B
			],
			12 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '2',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			13 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '2',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B
			],
			14 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_B',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			15 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_B',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B
			],
			16 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			17 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			18 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			19 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C ),
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			20 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			21 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => '1|2|4',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			22 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			23 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			],
			24 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => false,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_A
			],
			25 => [
				'flagable'          => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'condition'         => true,
				'expectedFlagValue' => ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C
			]
		];
	}

	/**
	 * Tests if the passed value will be switched correctly on condition while calling the method `ifSwitch()`.
	 * @param ConditionalManipulationInterface $flagable The conditional flagable to test.
	 * @param int|string|FlagableInterface $valueToSwitch The value to switch.
	 * @param bool $condition true if the value can be switched, false otherwise.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedConditionalFlagablesWithFlagsConditionsAndSwitchReturnValuesDataProvider
	 */
	public function testIfSwitchSetsFlagsOnConditionCorrectly( ConditionalManipulationInterface $flagable, $valueToSwitch, bool $condition, int $expectedFlagValue ): void
	{
		$flagable->ifSwitch( $valueToSwitch, $condition );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}
}
