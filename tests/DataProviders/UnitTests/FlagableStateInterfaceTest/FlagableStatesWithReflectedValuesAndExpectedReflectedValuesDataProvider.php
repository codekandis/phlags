<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with reflected values and expected reflected values.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithReflectedValuesAndExpectedReflectedValuesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = null,
				'expectedReflectedValues' => $reflectedValues
			],
			1 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = [],
				'expectedReflectedValues' => $reflectedValues
			],
			2 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = [
					'FLAG_A'
				],
				'expectedReflectedValues' => $reflectedValues
			],
			3 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = [
					'FLAG_A',
					'FLAG_B'
				],
				'expectedReflectedValues' => $reflectedValues
			],
			4 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = [
					'FLAG_A',
					'FLAG_B',
					'FLAG_C'
				],
				'expectedReflectedValues' => $reflectedValues
			],
			5 => [
				'flagableState'           => new FlagableState(),
				'reflectedValues'         => $reflectedValues = [
					'FLAG_A',
					'FLAG_C'
				],
				'expectedReflectedValues' => $reflectedValues
			]
		];
	}
}
