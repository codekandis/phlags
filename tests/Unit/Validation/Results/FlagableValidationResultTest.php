<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation\Results;

use CodeKandis\Phlags\Validation\Results\FlagableValidationResult;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Validation\FlagableValidationResult'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class FlagableValidationResultTest extends TestCase
{
	/**
	 * Tests that provided data are stored and returned correctly.
	 * @param array $errorMessages The error messages of the validation.
	 * @param int $maxValue The maximum value of the flagable.
	 * @param bool $succeeded The success state of the validation.
	 * @param bool $failed The fail state of the validiation.
	 * @dataProvider flagableValidationResultDataProvider
	 */
	public function tests( array $errorMessages, int $maxValue, bool $succeeded, bool $failed ): void
	{
		$validationResult = new FlagableValidationResult( $errorMessages, $maxValue );
		$this->assertEquals( $errorMessages, $validationResult->getErrorMessages() );
		$this->assertEquals( $maxValue, $validationResult->getMaxValue() );
		$this->assertEquals( $succeeded, $validationResult->succeeded() );
		$this->assertEquals( $failed, $validationResult->failed() );
	}

	/**
	 * Provides the data sets with validation result data.
	 * @return array The data sets.
	 */
	public function flagableValidationResultDataProvider(): array
	{
		return [
			[
				'errorMessages' => [],
				'maxValue'      => 1023,
				'succeeded'     => true,
				'failed'        => false,
			],
			[
				'errorMessages' => [
					'foobar',
					'barfoo',
				],
				'maxValue'      => 1023,
				'succeeded'     => false,
				'failed'        => true,
			],
		];
	}
}
