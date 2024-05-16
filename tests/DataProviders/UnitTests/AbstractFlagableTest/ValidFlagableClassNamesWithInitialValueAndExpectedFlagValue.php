<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\AbstractFlagableTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagable class names with initial value and expected flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagableClassNamesWithInitialValueAndExpectedFlagValue implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => $initialValue = ValidFlagableFixture::NONE,
				'expectedFlagValue'      => $initialValue
			],
			1  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => new ValidFlagableFixture(),
				'expectedFlagValue'      => ValidFlagableFixture::NONE
			],
			2  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => '0',
				'expectedFlagValue'      => ValidFlagableFixture::NONE
			],
			3  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => 'NONE',
				'expectedFlagValue'      => ValidFlagableFixture::NONE
			],
			4  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => $initialValue = ValidFlagableFixture::FLAG_A,
				'expectedFlagValue'      => $initialValue
			],
			5  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A ),
				'expectedFlagValue'      => $initialValue
			],
			6  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => '1',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A
			],
			7  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => 'FLAG_A',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A
			],
			8  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => $initialValue = ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B,
				'expectedFlagValue'      => $initialValue
			],
			9  => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedFlagValue'      => $initialValue
			],
			10 => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => '1|2',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			11 => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => 'FLAG_A|FLAG_B',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			12 => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => '1|FLAG_B',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			13 => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => 'FLAG_A|2',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			],
			14 => [
				'validFlagableClassName' => ValidFlagableFixture::class,
				'initialValue'           => '1|2',
				'expectedFlagValue'      => ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B
			]
		];
	}
}
