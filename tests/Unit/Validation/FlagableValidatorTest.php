<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\Tests\Fixtures\InvalidPermissions;
use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
use CodeKandis\Phlags\Validation\FlagableValidator;
use PHPUnit\Framework\TestCase;
use function sprintf;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Validation\FlagableValidator'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class FlagableValidatorTest extends TestCase
{
	/**
	 * Tests if the flagable validator is working as expected.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable to validate.
	 * @param array $errorMessages The error messages of the validation.
	 * @param int $expectedMaxValue The maximum value of the flagable.
	 * @param bool $expectedSucceeded The success state of the validation.
	 * @dataProvider flagableDataProvider
	 */
	public function testsProperValidation( string $flagableClassName, array $reflectedFlags, array $errorMessages, int $expectedMaxValue, bool $expectedSucceeded ): void
	{
		$validator = new FlagableValidator();
		$validator->validate( $flagableClassName, $reflectedFlags );

		static::assertEquals( $errorMessages, $validator->getErrorMessages() );
		static::assertEquals( $expectedMaxValue, $validator->getMaxValue() );
		static::assertEquals( $expectedSucceeded, $validator->succeeded() );
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
				'reflectedFlags'    => [
					'NONE'      => 0,
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'errorMessages'     => [],
				'expectedMaxValue'  => 7,
				'expectedSucceeded' => true
			],
			[
				'flagableClassName' => InvalidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD_1'   => 2,
					'UREAD_2'   => 2,
					'UEXECUTE'  => 5,
					'GREAD'     => 8,
					'GEXECUTE'  => 32,
				],
				'errorMessages'     => [
					sprintf(
						"Duplicate flag '2' in '%s::%s'.",
						InvalidPermissions::class,
						'UREAD_2'
					),
					sprintf(
						"Invalid value '5' in flag in '%s::%s'. Flag must be a power of 2.",
						InvalidPermissions::class,
						'UEXECUTE'
					),
					sprintf(
						"Missing flag with value '%d' in '%s'.",
						4,
						InvalidPermissions::class
					),
					sprintf(
						"Missing flag with value '%d' in '%s'.",
						16,
						InvalidPermissions::class
					),
				],
				'expectedMaxValue'  => 43,
				'expectedSucceeded' => false
			],
		];
	}
}
