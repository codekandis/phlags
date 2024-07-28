<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with validation throwable and expected validation throwable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithValidationThrowableAndExpectedValidationThrowableDataProvider implements DataProviderInterface
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
				'validationThrowable'         => $validationThrowable = null,
				'expectedValidationThrowable' => $validationThrowable
			],
			1 => [
				'flagableState'               => new FlagableState(),
				'validationThrowable'         => $validationThrowable = new InvalidFlagableException(),
				'expectedValidationThrowable' => $validationThrowable
			],
			2 => [
				'flagableState'               => new FlagableState(),
				'validationThrowable'         => $validationThrowable = new class() extends InvalidFlagableException {
				},
				'expectedValidationThrowable' => $validationThrowable
			]
		];
	}
}
