<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Phlags\FlagableInterface;
use Override;
use RuntimeException;
use function sprintf;

/**
 * Represents an exception if a value passed to the flagable is invalid.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class InvalidValueException extends RuntimeException implements InvalidValueExceptionInterface
{
	/**
	 * Represents the exception message if a value is invalid.
	 */
	public const string EXCEPTION_MESSAGE_VALUE_IS_INVALID = 'The value `%s` is invalid.';

	/**
	 * Stores the context error messages of the exception.
	 * @var string[]
	 */
	private array $contextErrorMessages = [];

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public static function with_invalidValue( int|string|FlagableInterface $invalidValue ): static
	{
		return new static(
			sprintf( static::EXCEPTION_MESSAGE_VALUE_IS_INVALID, $invalidValue )
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
