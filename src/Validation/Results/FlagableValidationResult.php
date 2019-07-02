<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Validation\Results;

/**
 * Represents the validation result of the flagable validation.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidationResult implements FlagableValidationResultInterface
{
	/**
	 * Stores the error messages of the flagable validation.
	 * @var string[]
	 */
	private $errorMessages;

	/**
	 * Stores the maximum value of the flagable.
	 * @var int
	 */
	private $maxValue;

	/**
	 * Constructor method.
	 * @param string[] $errorMessages The error messages of the flagable validation.
	 * @param int $maxValue The maximum value of the flagable.
	 */
	public function __construct( array $errorMessages, int $maxValue )
	{
		$this->errorMessages = $errorMessages;
		$this->maxValue      = $maxValue;
	}

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
	public function getMaxValue(): int
	{
		return $this->maxValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function succeeded(): bool
	{
		return $this->errorMessages === [];
	}

	/**
	 * {@inheritdoc}
	 */
	public function failed(): bool
	{
		return $this->errorMessages !== [];
	}
}
