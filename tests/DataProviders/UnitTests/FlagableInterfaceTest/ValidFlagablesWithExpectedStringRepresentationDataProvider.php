<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with expected string representation.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithExpectedStringRepresentationDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validFlagable'                => new ValidFlagableFixture(),
				'expectedStringRepresentation' => 'NONE'
			],
			1 => [
				'validFlagable'                => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedStringRepresentation' => 'FLAG_A'
			],
			2 => [
				'validFlagable'                => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_B'
			],
			3 => [
				'validFlagable'                => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_B|FLAG_C'
			],
			4 => [
				'validFlagable'                => new ValidFlagableFixture( ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_B|FLAG_C'
			],
			5 => [
				'validFlagable'                => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_C'
			]
		];
	}
}
