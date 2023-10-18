<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidFlagableExceptionInterface;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;
use CodeKandis\Types\BaseObject;
use Override;
use function asort;

/**
 * Represents a flagable state.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableState extends BaseObject implements FlagableStateInterface
{
	/**
	 * Stores if the flagable has been validated.
	 */
	private bool $hasBeenValidated = false;

	/**
	 * Stores the thrown exception of the validation of the flagable.
	 */
	private ?InvalidFlagableExceptionInterface $validationException = null;

	/**
	 * Stores the reflected flags of the flagable.
	 * @var ?string[]
	 */
	private ?array $reflectedFlags = [];

	/**
	 * Stores the maximum flag value of the flagable.
	 */
	private ?int $maximumValue = FlagableInterface::NONE;

	/**
	 * Stores the value validator of the flagable.
	 */
	private ?ValueValidatorInterface $valueValidator = null;

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getHasBeenValidated(): bool
	{
		return $this->hasBeenValidated;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setHasBeenValidated( bool $hasBeenValidated ): void
	{
		$this->hasBeenValidated = $hasBeenValidated;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getValidationException(): ?InvalidFlagableExceptionInterface
	{
		return $this->validationException;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setValidationException( ?InvalidFlagableExceptionInterface $validationException ): void
	{
		$this->validationException = $validationException;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getReflectedFlags(): ?array
	{
		return $this->reflectedFlags;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setReflectedFlags( ?array $reflectedFlags ): void
	{
		if ( null !== $reflectedFlags )
		{
			asort( $reflectedFlags );
		}
		$this->reflectedFlags = $reflectedFlags;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getMaximumValue(): ?int
	{
		return $this->maximumValue;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setMaximumValue( ?int $maximumValue ): void
	{
		$this->maximumValue = $maximumValue;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function getValueValidator(): ?ValueValidatorInterface
	{
		return $this->valueValidator;
	}

	/**
	 * @inheritDoc
	 */
	#[Override]
	public function setValueValidator( ?ValueValidatorInterface $valueValidator ): void
	{
		$this->valueValidator = $valueValidator;
	}
}
