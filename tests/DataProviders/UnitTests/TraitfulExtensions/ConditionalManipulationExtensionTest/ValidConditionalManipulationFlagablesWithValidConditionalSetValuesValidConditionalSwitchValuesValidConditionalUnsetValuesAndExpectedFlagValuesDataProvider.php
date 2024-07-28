<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationExtensionTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid conditional manipulation flagables with valid conditional set values, valid conditional switch values, valid conditional unset values and expected flag values.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithValidConditionalSetValuesValidConditionalSwitchValuesValidConditionalUnsetValuesAndExpectedFlagValuesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue_1'                      => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'setCondition_1'                       => false,
				'validSetValue_2'                      => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'setCondition_2'                       => true,
				'validSetValue_3'                      => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'setCondition_3'                       => false,
				'validSetValue_4'                      => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'setCondition_4'                       => true,
				'validSetValue_5'                      => ValidConditionalManipulationFlagableFixture::FLAG_C,
				'setCondition_5'                       => true,
				'validSwitchValue_1'                   => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'switchCondition_1'                    => false,
				'validSwitchValue_2'                   => ValidConditionalManipulationFlagableFixture::FLAG_B,
				'switchCondition_2'                    => true,
				'validUnsetValue_1'                    => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'unsetCondition_1'                     => false,
				'validUnsetValue_2'                    => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'unsetCondition_2'                     => true,
				'expectedFlagValue_1'                  => ValidConditionalManipulationFlagableFixture::NONE,
				'expectedFlagValue_2'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_3'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_4'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B,
				'expectedFlagValue_5'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_6'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_7'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_8'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_9'                  => ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			1 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue_1'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'setCondition_1'                       => false,
				'validSetValue_2'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'setCondition_2'                       => true,
				'validSetValue_3'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'setCondition_3'                       => false,
				'validSetValue_4'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'setCondition_4'                       => true,
				'validSetValue_5'                      => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_C ),
				'setCondition_5'                       => true,
				'validSwitchValue_1'                   => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'switchCondition_1'                    => false,
				'validSwitchValue_2'                   => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_B ),
				'switchCondition_2'                    => true,
				'validUnsetValue_1'                    => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'unsetCondition_1'                     => false,
				'validUnsetValue_2'                    => new ( ValidConditionalManipulationFlagableFixture::class )( ValidConditionalManipulationFlagableFixture::FLAG_A ),
				'unsetCondition_2'                     => true,
				'expectedFlagValue_1'                  => ValidConditionalManipulationFlagableFixture::NONE,
				'expectedFlagValue_2'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_3'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_4'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B,
				'expectedFlagValue_5'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_6'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_7'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_8'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_9'                  => ValidConditionalManipulationFlagableFixture::FLAG_C
			],
			2 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'validSetValue_1'                      => 'FLAG_A',
				'setCondition_1'                       => false,
				'validSetValue_2'                      => 'FLAG_A',
				'setCondition_2'                       => true,
				'validSetValue_3'                      => 'FLAG_B',
				'setCondition_3'                       => false,
				'validSetValue_4'                      => 'FLAG_B',
				'setCondition_4'                       => true,
				'validSetValue_5'                      => 'FLAG_C',
				'setCondition_5'                       => true,
				'validSwitchValue_1'                   => 'FLAG_B',
				'switchCondition_1'                    => false,
				'validSwitchValue_2'                   => 'FLAG_B',
				'switchCondition_2'                    => true,
				'validUnsetValue_1'                    => 'FLAG_A',
				'unsetCondition_1'                     => false,
				'validUnsetValue_2'                    => 'FLAG_A',
				'unsetCondition_2'                     => true,
				'expectedFlagValue_1'                  => ValidConditionalManipulationFlagableFixture::NONE,
				'expectedFlagValue_2'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_3'                  => ValidConditionalManipulationFlagableFixture::FLAG_A,
				'expectedFlagValue_4'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B,
				'expectedFlagValue_5'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_6'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_B | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_7'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_8'                  => ValidConditionalManipulationFlagableFixture::FLAG_A | ValidConditionalManipulationFlagableFixture::FLAG_C,
				'expectedFlagValue_9'                  => ValidConditionalManipulationFlagableFixture::FLAG_C
			]
		];
	}
}
