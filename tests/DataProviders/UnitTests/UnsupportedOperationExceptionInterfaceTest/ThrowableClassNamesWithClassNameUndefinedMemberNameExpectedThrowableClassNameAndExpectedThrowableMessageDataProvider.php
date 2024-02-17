<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest;

use CodeKandis\Phlags\UnsupportedOperationException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing throwable class names with class name, undefined member name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableClassNamesWithClassNameUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'throwableClassName'         => $throwableClassName = UnsupportedOperationException::class,
				'className'                  => $className = 'foobar',
				'undefinedMemberName'        => $undefinedMemberName = 'barfoo',
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( UnsupportedOperationException::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_MEMBER, $className, $undefinedMemberName )
			]
		];
	}
}
