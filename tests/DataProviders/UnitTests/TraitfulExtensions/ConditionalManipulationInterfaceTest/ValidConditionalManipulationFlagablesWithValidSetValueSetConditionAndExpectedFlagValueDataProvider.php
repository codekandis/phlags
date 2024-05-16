<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid conditional manipulation flagables with valid set value, set condition and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithValidSetValueSetConditionAndExpectedFlagValueDataProvider implements DataProviderInterface
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
				'validSetValue'                        => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			1  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			2  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			3  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			4  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => '1',
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			5  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => '1',
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			6  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => 'FLAG_A',
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			7  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue'                        => 'FLAG_A',
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			8  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			9  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			10 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			11 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			12 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => '1|2|4',
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			13 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => '1|2|4',
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			14 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => 'FLAG_A|FLAG_B|FLAG_C',
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			15 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => 'FLAG_A|FLAG_B|FLAG_C',
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			16 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => 'FLAG_A|2|FLAG_C',
				'setCondition'                         => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			17 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validSetValue'                        => 'FLAG_A|2|FLAG_C',
				'setCondition'                         => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C
			]
		];
	}
}
