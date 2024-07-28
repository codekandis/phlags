<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with validation state and expected validation state.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithValidationStateAndExpectedValidationStateDataProvider implements DataProviderInterface
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
				'validationState'         => $validationState = false,
				'expectedValidationState' => $validationState
			],
			1 => [
				'flagableState'           => new FlagableState(),
				'validationState'         => $validationState = true,
				'expectedValidationState' => $validationState
			]
		];
	}
}
