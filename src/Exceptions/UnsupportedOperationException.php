<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Exceptions;

use LogicException;

/**
 * Represents an exception if an invalid member has been accessed.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
class UnsupportedOperationException extends LogicException
{
}
