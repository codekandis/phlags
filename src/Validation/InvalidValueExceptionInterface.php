<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\ContextualErrorMessagesExceptionInterface;
use CodeKandis\Types\InvalidValueExceptionInterface as OriginInvalidValueExceptionInterface;

/**
 * Represents the interface of any exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface InvalidValueExceptionInterface extends OriginInvalidValueExceptionInterface, ContextualErrorMessagesExceptionInterface
{
}
