<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid flagables with invalid value, expected exception class name and expected exception message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithInvalidValueExpectedExceptionClassNameAndExpectedExceptionMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = -1,
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			1 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = -42,
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			2 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 42,
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			3 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = '-42',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			4 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = '42',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			5 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_D',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			6 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|FLAG_D',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			7 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|-42',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			8 => [
				'flagableClassName'          => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|42',
				'expectedExceptionClassName' => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			]
		];
	}
}
