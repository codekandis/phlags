<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\UnsupportedOperationExceptionInterfaceTest;

use CodeKandis\Phlags\UnsupportedOperationException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing throwable class names with class name, undefined static method name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowableClassNamesWithClassNameUndefinedStaticMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
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
				'undefinedStaticMethodName'  => $undefinedStaticMethodName = 'barfoo',
				'expectedThrowableClassName' => $throwableClassName,
				'expectedThrowableMessage'   => sprintf( UnsupportedOperationException::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_STATIC_METHOD, $className, $undefinedStaticMethodName )
			]
		];
	}
}
