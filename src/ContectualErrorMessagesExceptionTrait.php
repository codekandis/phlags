<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use Override;

/**
 * Represents a trait of any exception with context error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
trait ContectualErrorMessagesExceptionTrait
{
	/**
	 * Stores the error messages of the exception.
	 * @var string[]
	 */
	private array $contextErrorMessages = [];

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
