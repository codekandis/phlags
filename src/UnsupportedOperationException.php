<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use LogicException;
use Override;
use function sprintf;

/**
 * Represents an exception if an invalid member has been accessed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class UnsupportedOperationException extends LogicException implements UnsupportedOperationExceptionInterface
{
	/**
	 * Represents the exception message if an attempt to access an undefined member has been made.
	 * @var string
	 */
	public const string EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_MEMBER = 'The access of the undefined member `%s::%s` is not supported.';

	/**
	 * Represents the exception message if an attempt to access an undefined method has been made.
	 * @var string
	 */
	public const string EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_METHOD = 'The access of the undefined method `%s::%s()` is not supported.';

	/**
	 * Represents the exception message if an attempt to access an undefined static method has been made.
	 * @var string
	 */
	public const string EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_STATIC_METHOD = 'The access of the undefined static method `%s::%s()` is not supported.';

	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function with_classNameAndUndefinedMemberName( string $className, string $undefinedMemberName ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_MEMBER, $className, $undefinedMemberName )
		);
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function with_classNameAndUndefinedMethodName( string $className, string $undefinedMethodName ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_METHOD, $className, $undefinedMethodName )
		);
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function with_classNameAndUndefinedStaticMethodName( string $className, string $undefinedStaticMethodName ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_ACCESSING_UNDEFINED_STATIC_METHOD, $className, $undefinedStaticMethodName )
		);
	}
}
