<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid conditional manipulation flagables with valid unset value, unset condition and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithValidUnsetValueUnsetConditionAndExpectedFlagValueDataProvider implements DataProviderInterface
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
				'validUnsetValue'                      => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			1  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			2  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			3  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			4  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => '1',
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			5  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => '1',
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			6  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => 'FLAG_A',
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			7  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validUnsetValue'                      => 'FLAG_A',
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			8  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			9  => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			10 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			11 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			12 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => '1|2|4',
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			13 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => '1|2|4',
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			14 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => 'FLAG_A|FLAG_B|FLAG_C',
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			15 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => 'FLAG_A|FLAG_B|FLAG_C',
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			],
			16 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => 'FLAG_A|2|FLAG_C',
				'unsetCondition'                       => false,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::FLAG_A
			],
			17 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'validUnsetValue'                      => 'FLAG_A|2|FLAG_C',
				'unsetCondition'                       => true,
				'expectedFlagValue'                    => ValidConditionalManipulationFlagableFixture::NONE
			]
		];
	}
}
