<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\AbstractFlagableTest;

use CodeKandis\Phlags\Tests\Fixtures\InvalidFlagableFixture;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing invalid flagable class names with expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableClassNamesWithExpectedThrowableClassNameAndExpectedThrowableMessage implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'invalidFlagableClassName'   => $invalidFlagableClassName = InvalidFlagableFixture::class,
				'expectedThrowableClassName' => InvalidFlagableExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( InvalidFlagableException::EXCEPTION_MESSAGE_INVALID_FLAGABLE, $invalidFlagableClassName )
			]
		];
	}
}
