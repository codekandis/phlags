<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests\Unit\Validation
{

    use CodeKandis\Phlags\Tests\Fixtures\InvalidPermissions;
    use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
    use CodeKandis\Phlags\Validation\FlagableValidator;
    use PHPUnit\Framework\TestCase;

    /**
     * Represents the test case for the class 'CodeKandis\Phlags\Validation\FlagableValidator'.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    class FlagableValidatorTest extends TestCase
    {
        /**
         * Tests if the flagable validator is working as expected.
         * @param string $flagableClassName The class name of the flagable to validate.
         * @param array  $errorMessages     The error messages of the validation.
         * @param int    $maxValue          The maximum value of the flagable.
         * @param bool   $succeeded         The success state of the validation.
         * @param bool   $failed            The fail state of the validiation.
         * @dataProvider flagableDataProvider
         */
        public function testsProperValidation(
            string $flagableClassName,
            array $errorMessages,
            int $maxValue,
            bool $succeeded,
            bool $failed
        ): void
        {
            $validationResult = ( new FlagableValidator() )->validate( $flagableClassName );
            $this->assertEquals( $errorMessages, $validationResult->getErrorMessages() );
            $this->assertEquals( $maxValue, $validationResult->getMaxValue() );
            $this->assertEquals( $succeeded, $validationResult->succeeded() );
            $this->assertEquals( $failed, $validationResult->failed() );
        }

        /**
         * Provides the data to validate a flagable.
         * @return array The data sets.
         */
        public function flagableDataProvider(): array
        {
            return [
                [
                    'flagableClassName' => ValidPermissions::class,
                    'errorMessages'     => [],
                    'maxValue'          => 7,
                    'succeeded'         => true,
                    'failed'            => false,
                ],
                [
                    'flagableClassName' => InvalidPermissions::class,
                    'errorMessages'     => [
                        "Duplicate flag '2' in 'CodeKandis\Phlags\Tests\Fixtures\InvalidPermissions::UREAD_2'.",
                        "Invalid value '5' in flag in 'CodeKandis\Phlags\Tests\Fixtures\InvalidPermissions::UEXECUTE'. Flag must be a power of 2.",
                    ],
                    'maxValue'          => 7,
                    'succeeded'         => false,
                    'failed'            => true,
                ],
            ];
        }
    }
}