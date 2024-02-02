<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\FlagableInterfaceTest;

use CodeKandis\Phlags\Tests\Fixtures\ValidFlagableFixture;
use CodeKandis\PhpUnit\DataProviderInterface;
use CodeKandis\Types\PropertyNotFoundException;
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
				'expectedThrowableClassName' => PropertyNotFoundException::class,
				'expectedThrowableMessage'   => sprintf( PropertyNotFoundException::EXCEPTION_MESSAGE_PROPERTY_NOT_FOUND, $validFlagable::class, $undefinedMemberName )
			]
		];
	}
}
