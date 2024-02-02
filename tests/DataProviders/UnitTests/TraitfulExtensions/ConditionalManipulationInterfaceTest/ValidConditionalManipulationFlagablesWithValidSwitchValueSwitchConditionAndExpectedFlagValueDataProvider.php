<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid conditional manipulation flagables with valid switch value, switch condition and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithValidSwitchValueSwitchConditionAndExpectedFlagValueDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			1  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			2  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			3  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			4  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => '1',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			5  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => '1',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			6  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => 'FLAG_A',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			7  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSwitchValue'                     => 'FLAG_A',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			8  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			9  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B
			],
			10 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			11 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B
			],
			12 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => '2',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			13 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => '2',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B
			],
			14 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_B',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			15 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_B',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B
			],
			16 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			17 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			18 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			19 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			20 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => '1|2|4',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			21 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => '1|2|4',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			22 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_A|FLAG_B|FLAG_C',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			23 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_A|FLAG_B|FLAG_C',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			24 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_A|2|FLAG_C',
				'switchCondition'                      => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			25 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSwitchValue'                     => 'FLAG_A|2|FLAG_C',
				'switchCondition'                      => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			]
		];
	}
}
