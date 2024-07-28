<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with valid value to check and expected return value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithValidValueToCheckAndExpectedReturnValueDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => ValidFlagableFixture::NONE,
				'expectedReturnValue' => true
			],
			1  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )(),
				'expectedReturnValue' => true
			],
			2  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => '0',
				'expectedReturnValue' => true
			],
			3  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => 'NONE',
				'expectedReturnValue' => true
			],
			4  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A,
				'expectedReturnValue' => false
			],
			5  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => '1',
				'expectedReturnValue' => false
			],
			6  => [
				'validFlagable'       => new ValidFlagableFixture(),
				'validValueToCheck'   => 'FLAG_A',
				'expectedReturnValue' => false
			],
			7  => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A,
				'expectedReturnValue' => true
			],
			8  => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )( ValidFlagableFixture::FLAG_A ),
				'expectedReturnValue' => true
			],
			9  => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => '1',
				'expectedReturnValue' => true
			],
			10 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => 'FLAG_A',
				'expectedReturnValue' => true
			],
			11 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_B,
				'expectedReturnValue' => false
			],
			12 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => '2',
				'expectedReturnValue' => false
			],
			13 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToCheck'   => 'FLAG_B',
				'expectedReturnValue' => false
			],
			14 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A,
				'expectedReturnValue' => true
			],
			15 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )( ValidFlagableFixture::FLAG_A ),
				'expectedReturnValue' => true
			],
			16 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '1',
				'expectedReturnValue' => true
			],
			17 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => 'FLAG_A',
				'expectedReturnValue' => true
			],
			18 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B,
				'expectedReturnValue' => true
			],
			19 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedReturnValue' => true
			],
			20 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '1|2',
				'expectedReturnValue' => true
			],
			21 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => 'FLAG_A|FLAG_B',
				'expectedReturnValue' => true
			],
			22 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '1|FLAG_B',
				'expectedReturnValue' => true
			],
			23 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => 'FLAG_A|2',
				'expectedReturnValue' => true
			],
			24 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '1|2',
				'expectedReturnValue' => true
			],
			25 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '3',
				'expectedReturnValue' => true
			],
			26 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_C,
				'expectedReturnValue' => false
			],
			27 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => '4',
				'expectedReturnValue' => false
			],
			28 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToCheck'   => 'FLAG_C',
				'expectedReturnValue' => false
			],
			29 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A,
				'expectedReturnValue' => true
			],
			30 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )( ValidFlagableFixture::FLAG_A ),
				'expectedReturnValue' => true
			],
			31 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => '1',
				'expectedReturnValue' => true
			],
			32 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => 'FLAG_A',
				'expectedReturnValue' => true
			],
			33 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C,
				'expectedReturnValue' => true
			],
			34 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => new ( ValidFlagableFixture::class )( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedReturnValue' => true
			],
			35 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => '1|2|3',
				'expectedReturnValue' => true
			],
			36 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => 'FLAG_A|FLAG_B|FLAG_C',
				'expectedReturnValue' => true
			],
			37 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => '1|FLAG_B|FLAG_C',
				'expectedReturnValue' => true
			],
			38 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => 'FLAG_A|2|FLAG_C',
				'expectedReturnValue' => true
			],
			39 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => '1|2|FLAG_C',
				'expectedReturnValue' => true
			],
			40 => [
				'validFlagable'       => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'validValueToCheck'   => '3|FLAG_C',
				'expectedReturnValue' => true
			]
		];
	}
}
