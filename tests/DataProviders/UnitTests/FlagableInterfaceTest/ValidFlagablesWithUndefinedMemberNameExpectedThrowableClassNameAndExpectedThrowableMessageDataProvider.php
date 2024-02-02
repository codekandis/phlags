<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\Phlags\UnsupportedOperationException;
use CodeKandis\Phlags\UnsupportedOperationExceptionInterface;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;
use function sprintf;

/**
 * Represents a data provider providing valid flagables with undefined member name, expected throwable class name and expected throwable message.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidFlagablesWithUndefinedMemberNameExpectedThrowableClassNameAndExpectedThrowableMessageDataProvider implements DataProviderInterface
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
				'undefinedMemberName'        => $undefinedMemberName = 'foobar',
				'expectedThrowableClassName' => UnsupportedOperationExceptionInterface::class,
				'expectedThrowableMessage'   => sprintf( UnsupportedOperationException::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_MEMBER, $validFlagable::class, $undefinedMemberName )
			]
		];
	}
}
