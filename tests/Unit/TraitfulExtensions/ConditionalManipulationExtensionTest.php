<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\TraitfulExtensions;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ConditionalManipulatableFlagable;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationExtension;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the trait 'CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationExtension'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class ConditionalManipulationExtensionTest extends TestCase
{
	/**
	 * Tests if the conditional manipulation methods works as expected.
	 * @param string $flagableClassName
	 * @param int|string|FlagableInterface $setValue_1 The first value to set.
	 * @param bool $setCondition_1 The first set condition.
	 * @param int $setResult_1 The flagable value after the first set.
	 * @param int|string|FlagableInterface $setValue_2 The second value to set.
	 * @param bool $setCondition_2 The second set condition.
	 * @param int $setResult_2 The flagable value after the second set.
	 * @param int|string|FlagableInterface $setValue_3 The third value to set.
	 * @param bool $setCondition_3 The third set condition.
	 * @param int $setResult_3 The flagable value after the third set.
	 * @param int|string|FlagableInterface $setValue_4 The fourth value to set.
	 * @param bool $setCondition_4 The fourth set condition.
	 * @param int $setResult_4 The flagable value after the fourth set.
	 * @param int|string|FlagableInterface $setValue_5 The fifth value to set.
	 * @param bool $setCondition_5 The fifth set condition.
	 * @param int $setResult_5 The flagable value after the fifth set.
	 * @param int|string|FlagableInterface $switchValue_1 The first value to switch.
	 * @param bool $switchCondition_1 The first switch condition.
	 * @param int $switchResult_1 The flagable value after the first switch.
	 * @param int|string|FlagableInterface $switchValue_2 The second value to switch.
	 * @param bool $switchCondition_2 The second switch condition.
	 * @param int $switchResult_2 The flagable value after the second switch.
	 * @param int|string|FlagableInterface $unsetValue_1 The first value to unset.
	 * @param bool $unsetCondition_1 The first unset condition.
	 * @param int $unsetResult_1 The flagable value after the first unset.
	 * @param int|string|FlagableInterface $unsetValue_2 The second value to unset.
	 * @param bool $unsetCondition_2 The second unset condition.
	 * @param int $unsetResult_2 The flagable value after the second unset.
	 * @dataProvider validConditionalManipulatableFlagableDataProvider
	 */
	public function testsConditionalManipulation( string $flagableClassName, $setValue_1, bool $setCondition_1, int $setResult_1, $setValue_2, bool $setCondition_2, int $setResult_2, $setValue_3, bool $setCondition_3, int $setResult_3, $setValue_4, bool $setCondition_4, int $setResult_4, $setValue_5, bool $setCondition_5, int $setResult_5, $switchValue_1, bool $switchCondition_1, int $switchResult_1, $switchValue_2, bool $switchCondition_2, int $switchResult_2, $unsetValue_1, bool $unsetCondition_1, int $unsetResult_1, $unsetValue_2, bool $unsetCondition_2, int $unsetResult_2 ): void
	{
		/**
		 * @var ConditionalManipulationExtension $flagable
		 */
		$flagable = new $flagableClassName;

		$flagable->ifSet( $setValue_1, $setCondition_1 );

		static::assertEquals( $setResult_1, $flagable->getValue() );

		$flagable->ifSet( $setValue_2, $setCondition_2 );

		static::assertEquals( $setResult_2, $flagable->getValue() );

		$flagable->ifSet( $setValue_3, $setCondition_3 );

		static::assertEquals( $setResult_3, $flagable->getValue() );

		$flagable->ifSet( $setValue_4, $setCondition_4 );

		static::assertEquals( $setResult_4, $flagable->getValue() );

		$flagable->ifSet( $setValue_5, $setCondition_5 );

		static::assertEquals( $setResult_5, $flagable->getValue() );

		$flagable->ifSwitch( $switchValue_1, $switchCondition_1 );

		static::assertEquals( $switchResult_1, $flagable->getValue() );

		$flagable->ifSwitch( $switchValue_2, $switchCondition_2 );

		static::assertEquals( $switchResult_2, $flagable->getValue() );

		$flagable->ifUnset( $unsetValue_1, $unsetCondition_1 );

		static::assertEquals( $unsetResult_1, $flagable->getValue() );

		$flagable->ifUnset( $unsetValue_2, $unsetCondition_2 );

		static::assertEquals( $unsetResult_2, $flagable->getValue() );
	}

	/**
	 * Provides the data sets with
	 * @return array The data sets.
	 */
	public function validConditionalManipulatableFlagableDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => ConditionalManipulatableFlagable::class,
				'setValue_1'        => ConditionalManipulatableFlagable::FLAG_A,
				'setCondition_1'    => false,
				'setResult_1'       => ConditionalManipulatableFlagable::NONE,
				'setValue_2'        => ConditionalManipulatableFlagable::FLAG_A,
				'setCondition_2'    => true,
				'setResult_2'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_3'        => ConditionalManipulatableFlagable::FLAG_B,
				'setCondition_3'    => false,
				'setResult_3'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_4'        => ConditionalManipulatableFlagable::FLAG_B,
				'setCondition_4'    => true,
				'setResult_4'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B,
				'setValue_5'        => ConditionalManipulatableFlagable::FLAG_C,
				'setCondition_5'    => true,
				'setResult_5'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_1'     => ConditionalManipulatableFlagable::FLAG_B,
				'switchCondition_1' => false,
				'switchResult_1'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_2'     => ConditionalManipulatableFlagable::FLAG_B,
				'switchCondition_2' => true,
				'switchResult_2'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_1'      => ConditionalManipulatableFlagable::FLAG_A,
				'unsetCondition_1'  => false,
				'unsetResult_1'     => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_2'      => ConditionalManipulatableFlagable::FLAG_A,
				'unsetCondition_2'  => true,
				'unsetResult_2'     => ConditionalManipulatableFlagable::FLAG_C,
			],
			1 => [
				'flagableClassName' => ConditionalManipulatableFlagable::class,
				'setValue_1'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'setCondition_1'    => false,
				'setResult_1'       => ConditionalManipulatableFlagable::NONE,
				'setValue_2'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'setCondition_2'    => true,
				'setResult_2'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_3'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'setCondition_3'    => false,
				'setResult_3'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_4'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'setCondition_4'    => true,
				'setResult_4'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B,
				'setValue_5'        => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_C ),
				'setCondition_5'    => true,
				'setResult_5'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_1'     => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'switchCondition_1' => false,
				'switchResult_1'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_2'     => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_B ),
				'switchCondition_2' => true,
				'switchResult_2'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_1'      => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'unsetCondition_1'  => false,
				'unsetResult_1'     => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_2'      => new ConditionalManipulatableFlagable( ConditionalManipulatableFlagable::FLAG_A ),
				'unsetCondition_2'  => true,
				'unsetResult_2'     => ConditionalManipulatableFlagable::FLAG_C,
			],
			2 => [
				'flagableClassName' => ConditionalManipulatableFlagable::class,
				'setValue_1'        => 'FLAG_A',
				'setCondition_1'    => false,
				'setResult_1'       => ConditionalManipulatableFlagable::NONE,
				'setValue_2'        => 'FLAG_A',
				'setCondition_2'    => true,
				'setResult_2'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_3'        => 'FLAG_B',
				'setCondition_3'    => false,
				'setResult_3'       => ConditionalManipulatableFlagable::FLAG_A,
				'setValue_4'        => 'FLAG_B',
				'setCondition_4'    => true,
				'setResult_4'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B,
				'setValue_5'        => 'FLAG_C',
				'setCondition_5'    => true,
				'setResult_5'       => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_1'     => 'FLAG_B',
				'switchCondition_1' => false,
				'switchResult_1'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_B | ConditionalManipulatableFlagable::FLAG_C,
				'switchValue_2'     => 'FLAG_B',
				'switchCondition_2' => true,
				'switchResult_2'    => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_1'      => 'FLAG_A',
				'unsetCondition_1'  => false,
				'unsetResult_1'     => ConditionalManipulatableFlagable::FLAG_A | ConditionalManipulatableFlagable::FLAG_C,
				'unsetValue_2'      => 'FLAG_A',
				'unsetCondition_2'  => true,
				'unsetResult_2'     => ConditionalManipulatableFlagable::FLAG_C,
			]
		];
	}
}
