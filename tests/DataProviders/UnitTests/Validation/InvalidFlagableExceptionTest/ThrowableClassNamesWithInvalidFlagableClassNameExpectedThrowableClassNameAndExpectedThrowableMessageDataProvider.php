<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\Validation\InvalidFlagableExceptionTest;

use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing throwable class names with invalid flagable class name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableClassNamesWithInvalidFlagableClassNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'throwableClassName'         => $throwableClassName = InvalidFlagableException::class,
				'invalidFlagableClassName'   => $invalidFlagableClassName = 'Foo\\Bar',
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( InvalidFlagableException::EXCEPTION_MESSAGE_INVALID_FLAGABLE, $invalidFlagableClassName )
			]
		];
	}
}
