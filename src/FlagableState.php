<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags;

use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\ValueValidatorInterface;

/**
 * Represents a flagable state.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableState implements FlagableStateInterface
{
	/**
	 * Stores if the flagable has been validated.
	 * @var bool
	 */
	private bool $hasBeenValidated = false;

	/**
	 * Stores the thrown exception of the validation of the flagable.
	 * @var ?InvalidFlagableException
	 */
	private ?InvalidFlagableException $validationException = null;

	/**
	 * Stores the reflected flags of the flagable.
	 * @var ?string[]
	 */
	private ?array $reflectedFlags = [];

	/**
	 * Stores the maximum value of the flagable.
	 * @var ?int
	 */
	private ?int $maxValue = FlagableInterface::NONE;

	/**
	 * Stores the value validator of the flagable.
	 * @var ?ValueValidatorInterface
	 */
	private ?ValueValidatorInterface $valueValidator = null;

	/**
	 * {@inheritdoc}
	 */
	public function getHasBeenValidated(): bool
	{
		return $this->hasBeenValidated;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setHasBeenValidated( bool $hasBeenValidated ): void
	{
		$this->hasBeenValidated = $hasBeenValidated;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getValidationException(): ?InvalidFlagableException
	{
		return $this->validationException;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setValidationException( ?InvalidFlagableException $validationException ): void
	{
		$this->validationException = $validationException;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getReflectedFlags(): ?array
	{
		return $this->reflectedFlags;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setReflectedFlags( ?array $reflectedFlags ): void
	{
		if ( null !== $reflectedFlags )
		{
			asort( $reflectedFlags );
		}
		$this->reflectedFlags = $reflectedFlags;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMaxValue(): ?int
	{
		return $this->maxValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setMaxValue( ?int $maxValue ): void
	{
		$this->maxValue = $maxValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getValueValidator(): ?ValueValidatorInterface
	{
		return $this->valueValidator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function setValueValidator( ?ValueValidatorInterface $valueValidator ): void
	{
		$this->valueValidator = $valueValidator;
	}
}
