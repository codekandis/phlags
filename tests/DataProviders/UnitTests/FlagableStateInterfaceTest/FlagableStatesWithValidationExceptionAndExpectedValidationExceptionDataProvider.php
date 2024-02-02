<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with validation exception and expected validation exception.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithValidationExceptionAndExpectedValidationExceptionDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableState'               => new FlagableState(),
				'validationException'         => $validationException = null,
				'expectedValidationException' => $validationException
			],
			1 => [
				'flagableState'               => new FlagableState(),
				'validationException'         => $validationException = new InvalidFlagableException(),
				'expectedValidationException' => $validationException
			],
			2 => [
				'flagableState'               => new FlagableState(),
				'validationException'         => $validationException = new class() extends InvalidFlagableException {
				},
				'expectedValidationException' => $validationException
			]
		];
	}
}
