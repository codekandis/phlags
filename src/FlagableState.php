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
	 * @var bool
	 */
	private bool $hasBeenValidated = false;

	/**
	 * Stores the thrown exception of the validation of the flagable.
	 * @var ?InvalidFlagableExceptionInterface
	 */
	private ?InvalidFlagableExceptionInterface $validationException = null;

	/**
	 * Stores the reflected flags of the flagable.
	 * @var ?string[]
	 */
	private ?array $reflectedFlags = [];

	/**
	 * Stores the maximum flag value of the flagable.
	 * @var ?int
	 */
	private ?int $maximumValue = FlagableInterface::NONE;

	/**
	 * Stores the value validator of the flagable.
	 * @var ?ValueValidatorInterface
	 */
	private ?ValueValidatorInterface $valueValidator = null;

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function getHasBeenValidated(): bool
	{
		return $this->hasBeenValidated;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function setHasBeenValidated( bool $hasBeenValidated ): void
	{
		$this->hasBeenValidated = $hasBeenValidated;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function getValidationException(): ?InvalidFlagableExceptionInterface
	{
		return $this->validationException;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function setValidationException( ?InvalidFlagableExceptionInterface $validationException ): void
	{
		$this->validationException = $validationException;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function getReflectedFlags(): ?array
	{
		return $this->reflectedFlags;
	}

	/**
	 * {@inheritdoc}
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
	 * {@inheritdoc}
	 */
	#[Override]
	public function getMaximumValue(): ?int
	{
		return $this->maximumValue;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function setMaximumValue( ?int $maximumValue ): void
	{
		$this->maximumValue = $maximumValue;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function getValueValidator(): ?ValueValidatorInterface
	{
		return $this->valueValidator;
	}

	/**
	 * {@inheritdoc}
	 */
	#[Override]
	public function setValueValidator( ?ValueValidatorInterface $valueValidator ): void
	{
		$this->valueValidator = $valueValidator;
	}
}
