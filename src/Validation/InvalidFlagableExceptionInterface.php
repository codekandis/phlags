<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\ContextualErrorMessagesExceptionInterface;

/**
 * Represents the interface of any exception if the validation of the flagable has been failed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface InvalidFlagableExceptionInterface extends ContextualErrorMessagesExceptionInterface
{
}
