<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Exceptions
{

    /**
     * Represents an exception if the validation of the flagable has been failed.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    class InvalidFlagableException extends \LogicException implements ErrorMessagesExceptionInterface
    {
        /**
         * Stores the error messages of the exception.
         * @var string[]
         */
        private $_errorMessages = [];

        /**
         * {@inheritdoc}
         * @see ErrorMessagesExceptionInterface::getErrorMessages()
         */
        public function getErrorMessages(): array
        {
            return $this->_errorMessages;
        }

        /**
         * {@inheritdoc}
         * @see ErrorMessagesExceptionInterface::withErrorMessages()
         */
        public function withErrorMessages( array $errorMessages ): ErrorMessagesExceptionInterface
        {
            $this->_errorMessages = $errorMessages;

            return $this;
        }
    }
}
