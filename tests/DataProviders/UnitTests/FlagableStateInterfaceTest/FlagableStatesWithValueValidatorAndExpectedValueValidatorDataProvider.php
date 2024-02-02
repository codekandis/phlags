<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableStateInterfaceTest;

use CodeKandis\Phlags\FlagableState;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing flagable states with value validator and expected value validator.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableStatesWithValueValidatorAndExpectedValueValidatorDataProvider implements DataProviderInterface
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
				'valueValidator'         => $valueValidator = null,
				'expectedValueValidator' => $valueValidator
			],
			1 => [
				'flagableState'          => new FlagableState(),
				'valueValidator'         => $valueValidator = new ValueValidator(),
				'expectedValueValidator' => $valueValidator
			],
			2 => [
				'flagableState'          => new FlagableState(),
				'valueValidator'         => $valueValidator = new class() extends ValueValidator {
				},
				'expectedValueValidator' => $valueValidator
			]
		];
	}
}
