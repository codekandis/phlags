<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\ContectualErrorMessagesExceptionTrait;
use CodeKandis\Types\InvalidValueException as OriginInvalidValueException;

/**
 * Represents an exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidValueException extends OriginInvalidValueException implements InvalidValueExceptionInterface
{
	use ContectualErrorMessagesExceptionTrait;
}
