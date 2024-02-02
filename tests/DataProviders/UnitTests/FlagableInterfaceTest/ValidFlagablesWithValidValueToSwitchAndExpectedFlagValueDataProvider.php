<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with valid value to switch and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithValidValueToSwitchAndExpectedFlagValueDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => ValidFlagableFixture::NONE,
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			1  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => new ValidFlagableFixture( ValidFlagableFixture::NONE ),
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			2  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => '0',
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			3  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => 'NONE',
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			4  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => '1|FLAG_B|4',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			5  => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSwitch' => ValidFlagableFixture::FLAG_A,
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			6  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A
			],
			7  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => '1',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A
			],
			8  => [
				'validFlagable'      => new ValidFlagableFixture(),
				'validValueToSwitch' => 'FLAG_A',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A
			],
			9  => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => ValidFlagableFixture::FLAG_A,
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_B
			],
			10 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_B
			],
			11 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => '1',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_B
			],
			12 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => 'FLAG_A',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_B
			],
			13 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B,
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			14 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			15 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => '1|2',
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			16 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => 'FLAG_A|FLAG_B',
				'expectedFlagValue'  => ValidFlagableFixture::NONE
			],
			17 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => ValidFlagableFixture::FLAG_C,
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			18 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_C ),
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			19 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => '4',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			20 => [
				'validFlagable'      => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSwitch' => 'FLAG_C',
				'expectedFlagValue'  => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			]
		];
	}
}
