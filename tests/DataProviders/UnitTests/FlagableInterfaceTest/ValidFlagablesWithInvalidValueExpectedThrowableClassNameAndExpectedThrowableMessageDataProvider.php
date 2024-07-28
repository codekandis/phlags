<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid flagables with invalid value, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = -1,
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			1 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = -42,
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			2 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 42,
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			3 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = '-42',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			4 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = '42',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			5 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_D',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			6 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|FLAG_D',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			7 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|-42',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			8 => [
				'validFlagable'              => new ValidFlagableFixture(),
				'invalidValue'               => $invalidValue = 'FLAG_A|42',
				'expectedThrowableClassName' => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			]
		];
	}
}
