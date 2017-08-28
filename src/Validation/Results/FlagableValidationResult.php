<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation\Results
{

    /**
     * Represents the validation result of the flagable validation.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    class FlagableValidationResult implements FlagableValidationResultInterface
    {
        /**
         * Stores the error messages of the flagable validation.
         * @var string[]
         */
        private $_errorMessages;

        /**
         * Stores the maximum value of the flagable.
         * @var int
         */
        private $_maxValue;

        /**
         * Constructor method.
         * @param string[] $errorMessages The error messages of the flagable validation.
         * @param int      $maxValue      The maximum value of the flagable.
         */
        public function __construct( array $errorMessages, int $maxValue )
        {
            $this->_errorMessages = $errorMessages;
            $this->_maxValue      = $maxValue;
        }

        /**
         * {@inheritdoc}
         * @see ValidationResultInterface::getErrorMessages()
         */
        public function getErrorMessages(): array
        {
            return $this->_errorMessages;
        }

        /**
         * {@inheritdoc}
         * @see FlagableValidationResultInterface::getMaxValue()
         */
        public function getMaxValue(): int
        {
            return $this->_maxValue;
        }

        /**
         * {@inheritdoc}
         * @see ValidationResultInterface::succeeded()
         */
        public function succeeded(): bool
        {
            return $this->_errorMessages === [];
        }

        /**
         * {@inheritdoc}
         * @see ValidationResultInterface::failed()
         */
        public function failed(): bool
        {
            return $this->_errorMessages !== [];
        }
    }
}
