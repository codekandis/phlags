<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\ValueValidatorInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\Validation\ValueValidator;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing value validators with valid flagable, reflected flags, maximum flag value, value, expected succeeded and expected error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValueValidatorsWithValidFlagableReflectedFlagsMaximumFlagValueValueExpectedSucceededAndExpectedErrorMessagesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => ValidFlagableFixture::FLAG_A,
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			],
			1  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			],
			2  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => 'FLAG_A',
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			],
			3  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => 'FLAG_A|FLAG_B',
				'expectedSucceeded'     => true,
				'expectedErrorMessages' => []
			],
			4  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => $value = 'foobar',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_UNRESOLVABLE_VALUE, $value )
				]
			],
			5  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => 'FLAG_A|FLAG_D',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_UNRESOLVABLE_VALUE, 'FLAG_D' )
				]
			],
			6  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => $value = -42,
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_INVALID_VALUE_TYPE, $value, ValidFlagableFixture::class )
				]
			],
			7  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => $value = -42.5,
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_INVALID_VALUE_TYPE, $value, ValidFlagableFixture::class )
				]
			],
			8  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => $value = '-42',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_INVALID_STRINGIFIED_VALUE_TYPE, $value, ValidFlagableFixture::class )
				]
			],
			9  => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => 7,
				'value'                 => $value = '-42.5',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_INVALID_STRINGIFIED_VALUE_TYPE, $value, ValidFlagableFixture::class )
				]
			],
			10 => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => $maximumFlagValue = 7,
				'value'                 => $value = 42,
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE, $value, $maximumFlagValue )
				]
			],
			11 => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => $maximumFlagValue = 7,
				'value'                 => $value = '42',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE, $value, $maximumFlagValue )
				]
			],
			12 => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => $maximumFlagValue = 7,
				'value'                 => 'FLAG_A|42',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_VALUE_EXEEDS_MAXIMUM_FLAG_VALUE, '42', $maximumFlagValue )
				]
			],
			13 => [
				'valueValidator'        => new ValueValidator(),
				'validFlagable'         => new ValidFlagableFixture(),
				'reflectedFlags'        => [
					'FLAG_A' => 1,
					'FLAG_B' => 2,
					'FLAG_C' => 4,
				],
				'maximumFlagValue'      => $maximumFlagValue = 7,
				'value'                 => 'FLAG_A|-42|FLAG_D',
				'expectedSucceeded'     => false,
				'expectedErrorMessages' => [
					sprintf( ValueValidator::ERROR_MESSAGE_INVALID_STRINGIFIED_VALUE_TYPE, '-42', ValidFlagableFixture::class ),
					sprintf( ValueValidator::ERROR_MESSAGE_UNRESOLVABLE_VALUE, 'FLAG_D' )
				]
			]
		];
	}
}
