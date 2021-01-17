<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\Exceptions\ErrorMessagesExceptionInterface;
use RuntimeException;

/**
 * Represents an exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidValueException extends RuntimeException implements ErrorMessagesExceptionInterface
{
	/**
	 * Stores the error messages of the exception.
	 * @var string[]
	 */
	private array $errorMessages = [];

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
