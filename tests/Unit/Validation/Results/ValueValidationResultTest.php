<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Unit\Validation\Results
{

    use CodeKandis\Phlags\Validation\Results\ValueValidationResult;
    use PHPUnit\Framework\TestCase;

    /**
     * Represents the test case for the class 'CodeKandis\Phlags\Validation\FlagableValidationResult'.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    final class ValueValidationResultTest extends TestCase
    {
        /**
         * Tests that provided data are stored and returned correctly.
         * @param array $errorMessages The error messages of the validation.
         * @param bool  $succeeded     The success state of the validation.
         * @param bool  $failed        The fail state of the validiation.
         * @dataProvider valueValidationResultDataProvider
         */
        public function tests( array $errorMessages, bool $succeeded, bool $failed ): void
        {
            $validationResult = new ValueValidationResult( $errorMessages );
            $this->assertEquals( $errorMessages, $validationResult->getErrorMessages() );
            $this->assertEquals( $succeeded, $validationResult->succeeded() );
            $this->assertEquals( $failed, $validationResult->failed() );
        }

        /**
         * Provides the data sets with validation result data.
         * @return array The data sets.
         */
        public function valueValidationResultDataProvider(): array
        {
            return [
                [
                    'errorMessages' => [],
                    'succeeded'     => true,
                    'failed'        => false,
                ],
                [
                    'errorMessages' => [
                        'foobar',
                        'barfoo',
                    ],
                    'succeeded'     => false,
                    'failed'        => true,
                ],
            ];
        }
    }
}