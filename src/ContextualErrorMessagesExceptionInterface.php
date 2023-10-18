<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

/**
 * Represents the interface of any exception with context error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
interface ContextualErrorMessagesExceptionInterface
{
	/**
	 * Gets the context error messages of the exception.
	 * @return string[] The context error messages of the exception.
	 */
	public function getContextErrorMessages(): array;

	/**
	 * Sets the context error messages of the exception.
	 * @param string[] $contextErrorMessages The context error messages of the exception.
	 * @return static
	 */
	public function setContextErrorMessages( string ...$contextErrorMessages ): static;
}
