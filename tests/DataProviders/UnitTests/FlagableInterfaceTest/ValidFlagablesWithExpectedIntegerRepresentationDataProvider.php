<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing valid flagables with expected integer representation.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithExpectedIntegerRepresentationDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::NONE ),
				'expectedIntegerRepresentation' => $initialValue
			],
			1 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A ),
				'expectedIntegerRepresentation' => $initialValue
			],
			2 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B ),
				'expectedIntegerRepresentation' => $initialValue
			],
			3 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedIntegerRepresentation' => $initialValue
			],
			4 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_B | ValidFlagableFixture::FLAG_C ),
				'expectedIntegerRepresentation' => $initialValue
			],
			5 => [
				'validFlagable'                 => new ValidFlagableFixture( $initialValue = ValidFlagableFixture::FLAG_A | ValidFlagableFixture::FLAG_C ),
				'expectedIntegerRepresentation' => $initialValue
			]
		];
	}
}
