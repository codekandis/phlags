<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Exceptions;

use RuntimeException;

/**
 * Represents an exception if the validation of the flagable has been failed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableException extends RuntimeException implements ErrorMessagesExceptionInterface
{
	/**
	 * Stores the error messages of the exception.
	 * @var string[]
	 */
	private $errorMessages = [];

	/**
	 * {@inheritdoc}
	 */
	public function getErrorMessages(): array
	{
		return $this->errorMessages;
	}

	/**
	 * {@inheritdoc}
	 */
	public function withErrorMessages( array $errorMessages ): ErrorMessagesExceptionInterface
	{
		$this->errorMessages = $errorMessages;

		return $this;
	}
}
