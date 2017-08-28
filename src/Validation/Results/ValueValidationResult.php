<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Validation\Results
{

    /**
     * Represents the validation result of the value validation.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    class ValueValidationResult implements ValidationResultInterface
    {
        /**
         * Stores the error messages of the flag value validation.
         * @var string[]
         */
        private $_errorMessages;

        /**
         * Constructor method.
         * @param string[] $errorMessages The error messages of the value validation.
         */
        public function __construct( array $errorMessages )
        {
            $this->_errorMessages = $errorMessages;
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
