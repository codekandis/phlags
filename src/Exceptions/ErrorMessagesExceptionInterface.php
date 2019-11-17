<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Exceptions;

/**
 * Represents the interface of all exceptions with error messages.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
interface ErrorMessagesExceptionInterface
{
	/**
	 * Gets the error messages of the exception.
	 * @return string[] The error messages of the exception.
	 */
	public function getErrorMessages(): array;

	/**
	 * Sets the error messages of the exception.
	 * @param string[] $errorMessages The error messages of the exception.
	 * @return self
	 */
	public function withErrorMessages( array $errorMessages ): self;
}
