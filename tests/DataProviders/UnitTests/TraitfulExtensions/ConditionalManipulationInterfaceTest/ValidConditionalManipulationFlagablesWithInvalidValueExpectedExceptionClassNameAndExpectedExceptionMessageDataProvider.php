<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\TraitfulExtensions\ConditionalManipulationInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidConditionalManipulationFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\Phlags\Validation\InvalidValueExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid conditional manipulation flagables with invalid value, expected exception class name and expected exception message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagablesWithInvalidValueExpectedExceptionClassNameAndExpectedExceptionMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = -1,
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			1 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = -42,
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			2 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = 42,
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			3 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = '-42',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			4 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = '42',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			5 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = 'FLAG_D',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			6 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = 'FLAG_A|FLAG_D',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			7 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = 'FLAG_A|-42',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			],
			8 => [
				'conditionalManipulationFlagableClassName' => new ValidConditionalManipulationFlagableFixture(),
				'invalidValue'                             => $invalidValue = 'FLAG_A|42',
				'expectedExceptionClassName'               => InvalidValueExceptionInterface::class,
				'expectedExceptionMessage'                 => sprintf( InvalidValueException::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
			]
		];
	}
}
