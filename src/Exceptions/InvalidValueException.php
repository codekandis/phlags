<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Exceptions;

use RuntimeException;

/**
 * Represents an exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
class InvalidValueException extends RuntimeException implements ErrorMessagesExceptionInterface
{
	/**
	 * Stores the error messages of the exception.
	 * @var string[]
	 */
	private $errorMessages = [];

	/**
	 * {@inheritdoc}
	 * @see ErrorMessagesExceptionInterface::getErrorMessages()
	 */
	public function getErrorMessages(): array
	{
		return $this->errorMessages;
	}

	/**
	 * {@inheritdoc}
	 * @see ErrorMessagesExceptionInterface::withErrorMessages()
	 */
	public function withErrorMessages( array $errorMessages ): ErrorMessagesExceptionInterface
	{
		$this->errorMessages = $errorMessages;

		return $this;
	}
}
