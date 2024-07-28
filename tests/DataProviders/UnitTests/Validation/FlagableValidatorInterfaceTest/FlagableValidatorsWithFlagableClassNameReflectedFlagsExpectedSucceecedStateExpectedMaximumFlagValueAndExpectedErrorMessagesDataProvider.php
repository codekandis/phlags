<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\FlagableValidatorInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\InvalidFlagableFixture;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing flagable validators with flagable class name, reflected flags, expected succeeced state, expected maximum flag value and expected error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidatorsWithFlagableClassNameReflectedFlagsExpectedSucceecedStateExpectedMaximumFlagValueAndExpectedErrorMessagesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableValidator'        => new FlagableValidator(),
				'flagableClassName'        =>
					( new class() {
					} )
						::class,
				'reflectedFlags'           => [
					'NONE'   => 0,
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'expectedSucceededState'   => true,
				'expectedMaximumFlagValue' => 7,
				'expectedErrorMessages'    => []
			],
			1 => [
				'flagableValidator'        => new FlagableValidator(),
				'flagableClassName'        => ValidFlagableFixture::class,
				'reflectedFlags'           => [
					'NONE'   => 0,
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'expectedSucceededState'   => true,
				'expectedMaximumFlagValue' => 7,
				'expectedErrorMessages'    => []
			],
			2 => [
				'flagableValidator'        => new FlagableValidator(),
				'flagableClassName'        => $flagableClassName = InvalidFlagableFixture::class,
				'reflectedFlags'           => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 2,
					'FLAG_D' => 5,
					'FLAG_E' => 8,
					'FLAG_F' => 32,
					'FLAG_G' => -42,
				],
				'expectedSucceededState'   => false,
				'expectedMaximumFlagValue' => 43,
				'expectedErrorMessages'    => [
					sprintf( FlagableValidator::ERROR_MESSAGE_DUPLICATE_FLAG, 2, $flagableClassName, 'FLAG_C' ),
					sprintf( FlagableValidator::ERROR_MESSAGE_INVALID_VALUE, 5, $flagableClassName, 'FLAG_D' ),
					sprintf( FlagableValidator::ERROR_MESSAGE_INVALID_TYPE, $flagableClassName, 'FLAG_G' ),
					sprintf( FlagableValidator::ERROR_MESSAGE_MISSING_FLAG, 4, $flagableClassName ),
					sprintf( FlagableValidator::ERROR_MESSAGE_MISSING_FLAG, 16, $flagableClassName )
				]
			]
		];
	}
}
