<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with valid value to unset and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithValidValueToUnsetAndExpectedFlagValueDataProvider implements DataProviderInterface
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
				'validValueToUnset' => ValidFlagableFixture::NONE,
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			1  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => new ValidFlagableFixture( ValidFlagableFixture::NONE ),
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			2  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => '0',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			3  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => 'NONE',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			4  => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'validValueToUnset' => ValidFlagableFixture::FLAG_A,
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			5  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			6  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => '1',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			7  => [
				'validFlagable'     => new ValidFlagableFixture(),
				'validValueToUnset' => 'FLAG_A',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			8  => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => ValidFlagableFixture::FLAG_A,
				'expectedFlagValue' => ValidFlagableFixture::FLAG_B
			],
			9  => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue' => ValidFlagableFixture::FLAG_B
			],
			10 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => '1',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_B
			],
			11 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => 'FLAG_A',
				'expectedFlagValue' => ValidFlagableFixture::FLAG_B
			],
			12 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B,
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			13 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			14 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => '1|2',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			],
			15 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'validValueToUnset' => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagableFixture::NONE
			]
		];
	}
}
