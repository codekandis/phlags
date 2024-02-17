<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use Override;
use RuntimeException;
use function sprintf;

/**
 * Represents an exception if the validation of the flagable has been failed.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidFlagableException extends RuntimeException implements InvalidFlagableExceptionInterface
{
	/**
	 * Represents the exception message if a flagable is invalid.
	 * @var string
	 */
	public const string EXCEPTION_MESSAGE_FLAGABLE_IS_INVALID = 'The flagable `%s` is invalid.';

	/**
	 * Stores the context error messages of the exception.
	 * @var string[]
	 */
	private array $contextErrorMessages = [];

	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function with_invalidFlagableClassName( string $invalidFlagableClassName ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_FLAGABLE_IS_INVALID, $invalidFlagableClassName )
		);
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getContextErrorMessages(): array
	{
		return $this->contextErrorMessages;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setContextErrorMessages( string ...$contextErrorMessages ): static
	{
		$this->contextErrorMessages = $contextErrorMessages;

		return $this;
	}
}
