<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

/**
 * Represents the interface of any exception if an invalid member has been accessed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface UnsupportedOperationExceptionInterface
{
	/**
	 * Static constructor method.
	 * @param string $className The name of the accessed class.
	 * @param string $undefinedMemberName The name of the undefined member.
	 */
	public static function with_classNameAndUndefinedMemberName( string $className, string $undefinedMemberName ): static;

	/**
	 * Static constructor method.
	 * @param string $className The name of the accessed class.
	 * @param string $undefinedMethodName The name of the undefined method.
	 */
	public static function with_classNameAndUndefinedMethodName( string $className, string $undefinedMethodName ): static;

	/**
	 * Static constructor method.
	 * @param string $className The name of the accessed class.
	 * @param string $undefinedStaticMethodName The name of the undefined static method.
	 */
	public static function with_classNameAndUndefinedStaticMethodName( string $className, string $undefinedStaticMethodName ): static;
}
