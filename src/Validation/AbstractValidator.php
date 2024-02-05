<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use Override;

/**
 * Represents the base class of all validators.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractValidator implements ValidatorInterface
{
	/**
	 * Stores the error messages of the validation.
	 * @var string[]
	 */
	protected array $errorMessages = [];

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function getErrorMessages(): array
	{
		return $this->errorMessages;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function succeeded(): bool
	{
		return [] === $this->errorMessages;
	}
}
