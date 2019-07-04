<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

abstract class AbstractValidator implements ValidatorInterface
{
	/**
	 * Stores the error messages of the validation.
	 * @var string[]
	 */
	protected $errorMessages = [];

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
	public function succeeded(): bool
	{
		return [] === $this->errorMessages;
	}
}
