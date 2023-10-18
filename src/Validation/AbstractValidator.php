<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation;

use CodeKandis\Types\BaseObject;
use Override;

/**
 * Represents the base class of all validators.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
abstract class AbstractValidator extends BaseObject implements ValidatorInterface
{
	/**
	 * Stores the error messages of the validation.
	 * @var string[]
	 */
	protected array $errorMessages = [];

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getErrorMessages(): array
	{
		return $this->errorMessages;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function succeeded(): bool
	{
		return [] === $this->errorMessages;
	}
}
