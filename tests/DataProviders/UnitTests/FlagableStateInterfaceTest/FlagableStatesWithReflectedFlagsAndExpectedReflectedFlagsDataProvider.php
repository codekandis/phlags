<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with reflected flags and expected reflected flags.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithReflectedFlagsAndExpectedReflectedFlagsDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = null,
				'expectedReflectedFlags' => $reflectedFlags
			],
			1 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = [],
				'expectedReflectedFlags' => $reflectedFlags
			],
			2 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = [
					'FLAG_A'
				],
				'expectedReflectedFlags' => $reflectedFlags
			],
			3 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = [
					'FLAG_A',
					'FLAG_B'
				],
				'expectedReflectedFlags' => $reflectedFlags
			],
			4 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = [
					'FLAG_A',
					'FLAG_B',
					'FLAG_C'
				],
				'expectedReflectedFlags' => $reflectedFlags
			],
			5 => [
				'flagableState'          => new FlagableState(),
				'reflectedFlags'         => $reflectedFlags = [
					'FLAG_A',
					'FLAG_C'
				],
				'expectedReflectedFlags' => $reflectedFlags
			]
		];
	}
}
