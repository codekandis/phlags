<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid conditional manipulation flagables with invalid value, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithInvalidValueExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = -1,
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			1 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = -42,
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			2 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = 42,
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			3 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = '-42',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			4 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = '42',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			5 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = 'FLAG_D',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			6 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = 'FLAG_A|FLAG_D',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			7 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = 'FLAG_A|-42',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			],
			8 => [
				'validConditionalManipulationFlagable' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                         => $invalidValue = 'FLAG_A|42',
				'expectedThrowableClassName'           => InvalidValueExceptionInterface::class,
				'expectedThrowableMessage'             => sprintf( InvalidValueException::EXCEPTION_MESSAGE_INVALID_VALUE, $invalidValue )
			]
		];
	}
}
