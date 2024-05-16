<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with maximum flag value and expected maximum flag value.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithMaximumFlagValueAndExpectedMaximumFlagValueDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableState'            => new FlagableState(),
				'maximumFlagValue'         => $maximumFlagValue = 0,
				'expectedMaximumFlagValue' => $maximumFlagValue
			],
			1 => [
				'flagableState'            => new FlagableState(),
				'maximumFlagValue'         => $maximumFlagValue = 1,
				'expectedMaximumFlagValue' => $maximumFlagValue
			],
			2 => [
				'flagableState'            => new FlagableState(),
				'maximumFlagValue'         => $maximumFlagValue = 2,
				'expectedMaximumFlagValue' => $maximumFlagValue
			],
			3 => [
				'flagableState'            => new FlagableState(),
				'maximumFlagValue'         => $maximumFlagValue = 4,
				'expectedMaximumFlagValue' => $maximumFlagValue
			]
		];
	}
}
