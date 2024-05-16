<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with valid value to set and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithValidValueToSetAndExpectedFlagValueDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => ValidFlagableFixture::NONE,
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			1  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => new ValidFlagableFixture(),
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			2  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '0',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			3  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'NONE',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			4  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => ValidFlagableFixture::FLAG_A,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			5  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			6  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			7  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			8  => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => ValidFlagableFixture::FLAG_B,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			9  => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			10 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => '2',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			11 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => 'FLAG_B',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			12 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => ValidFlagableFixture::NONE,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			13 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::NONE ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			14 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => '0',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			15 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToSet'   => 'NONE',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A
			],
			16 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSet'   => ValidFlagableFixture::FLAG_C,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			17 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_C ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			18 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSet'   => '4',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			19 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToSet'   => 'FLAG_C',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			20 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'validValueToSet'   => ValidFlagableFixture::FLAG_B,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			21 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			22 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'validValueToSet'   => '2',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			23 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'validValueToSet'   => 'FLAG_B',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			24 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			25 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			26 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1|2',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			27 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			28 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1|FLAG_B',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			29 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|2',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			30 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			31 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			32 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1|2|4',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			33 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|FLAG_B|FLAG_C',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			34 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1|FLAG_B|FLAG_C',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			35 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|2|FLAG_C',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			36 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|FLAG_B|4',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			37 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => '1|FLAG_B|4',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			],
			38 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToSet'   => 'FLAG_A|2|4',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C
			]
		];
	}
}
