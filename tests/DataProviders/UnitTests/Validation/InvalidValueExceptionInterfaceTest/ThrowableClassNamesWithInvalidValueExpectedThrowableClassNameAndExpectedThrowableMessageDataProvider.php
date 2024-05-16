<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\InvalidValueExceptionInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing throwable class names with invalid value, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableClassNamesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'throwableClassName'         => $throwableClassName = InvalidValueException::class,
				'invalidValue'               => $invalidValue = 1,
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			1 => [
				'throwableClassName'         => $throwableClassName = InvalidValueException::class,
				'invalidValue'               => $invalidValue = '1',
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			2 => [
				'throwableClassName'         => $throwableClassName = InvalidValueException::class,
				'invalidValue'               => $invalidValue = new ValidFlagableFixture( ValidFlagableFixture::FLAG_A ),
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			3 => [
				'throwableClassName'         => $throwableClassName = InvalidValueException::class,
				'invalidValue'               => $invalidValue = new ValidFlagableFixture( ValidFlagableFixture::FLAG_B ),
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			4 => [
				'throwableClassName'         => $throwableClassName = InvalidValueException::class,
				'invalidValue'               => $invalidValue = new ValidFlagableFixture( ValidFlagableFixture::FLAG_C ),
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			]
		];
	}
}
