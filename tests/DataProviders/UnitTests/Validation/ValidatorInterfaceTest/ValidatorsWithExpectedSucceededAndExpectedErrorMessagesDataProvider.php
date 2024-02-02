<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\ValidatorInterfaceTest;

use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing validators with expected succeeded and expected error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidatorsWithExpectedSucceededAndExpectedErrorMessagesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validator'             => new class() extends ValueValidator {
					protected array $errorMessages = [
						'foobar',
						'barfoo'
					];
				},
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					'foobar',
					'barfoo'
				]
			],
			1 => [
				'validator'             => new class() extends ValueValidator {
				},
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			],
			2 => [
				'validator'             => new class() extends FlagableValidator {
					protected array $errorMessages = [
						'foobar',
						'barfoo'
					];
				},
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					'foobar',
					'barfoo'
				]
			],
			3 => [
				'validator'             => new class() extends FlagableValidator {
				},
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			]
		];
	}
}
