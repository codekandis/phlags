<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with expected flagables.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithExpectedFlagablesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validFlagable'     => new ValidFlagableFixture(),
				'expectedFlagables' => [
					new ValidFlagableFixture()
				]
			],
			1 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedFlagables' => [
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_A )
				]
			],
			2 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_B ),
				'expectedFlagables' => [
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_B )
				]
			],
			3 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedFlagables' => [
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_B )
				]
			],
			4 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'expectedFlagables' => [
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_C )
				]
			],
			5 => [
				'validFlagable'     => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedFlagables' => [
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_B ),
					new ValidFlagableFixture( ValidFlagableFixture::FLAG_C )
				]
			]
		];
	}
}
