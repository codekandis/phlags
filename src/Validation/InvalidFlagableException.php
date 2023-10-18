<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\ContectualErrorMessagesExceptionTrait;
use CodeKandis\Types\RuntimeException;
use function sprintf;

/**
 * Represents an exception if the validation of the flagable has been failed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableException extends RuntimeException implements InvalidFlagableExceptionInterface
{
	use ContectualErrorMessagesExceptionTrait;

	/**
	 * Represents the exception message if a flagable is invalid.
	 * @var string
	 */
	public const string EXCEPTION_MESSAGE_INVALID_FLAGABLE = 'The flagable `%s` is invalid.';

	/**
	 * Static constructor method.
	 * @param string $invalidFlagableClassName The class name of the invalid flagable.
	 * @return static
	 */
	public static function with_invalidFlagableClassName( string $invalidFlagableClassName ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_INVALID_FLAGABLE, $invalidFlagableClassName )
		);
	}
}
