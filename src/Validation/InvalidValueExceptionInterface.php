<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\ContextualErrorMessagesExceptionInterface;
use CodeKandis\Phlags\FlagableInterface;

/**
 * Represents the interface of any exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface InvalidValueExceptionInterface extends ContextualErrorMessagesExceptionInterface
{
	/**
	 * Static constructor method.
	 * @param int|string|FlagableInterface $invalidValue The invalid value.
	 */
	public static function with_invalidValue( int|string|FlagableInterface $invalidValue ): static;
}
