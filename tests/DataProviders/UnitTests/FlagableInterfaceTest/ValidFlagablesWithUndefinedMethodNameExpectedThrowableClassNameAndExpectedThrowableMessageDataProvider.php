<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use CodeKandis\Types\MethodNotFoundException;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid flagables with undefined method name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithUndefinedMethodNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'validFlagable'              => $validFlagable = new ValidFlagableFixture(),
				'undefinedMethodName'        => $undefinedMethodName = 'foobar',
				'expectedThrowableClassName' => MethodNotFoundException::class,
				'expectedThrowableMessage'   => sprintf( MethodNotFoundException::EXCEPTION_MESSAGE_METHOD_NOT_FOUND, $validFlagable::class, $undefinedMethodName )
			]
		];
	}
}
