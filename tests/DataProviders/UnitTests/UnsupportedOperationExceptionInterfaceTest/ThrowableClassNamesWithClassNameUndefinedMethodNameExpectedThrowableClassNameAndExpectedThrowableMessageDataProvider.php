<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest;

use CodeKandis\Phlags\UnsupportedOperationException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing throwable class names with class name, undefined method name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableClassNamesWithClassNameUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
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
				'undefinedMethodName'        => $undefinedMethodName = 'barfoo',
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( UnsupportedOperationException::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_METHOD, $className, $undefinedMethodName )
			]
		];
	}
}
