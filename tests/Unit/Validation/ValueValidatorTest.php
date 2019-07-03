<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit\Validation;

use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
use CodeKandis\Phlags\Validation\ValueValidator;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\Validation\ValueValidator'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValueValidatorTest extends TestCase
{
	/**
	 * Tests if the flagable validator is working as expected.
	 * @param string $flagableClassName The class name of the flagable to validate.
	 * @param array $reflectedFlags The reflected flags of the flagable.
	 * @param int $maxValue The maximum value of the flagable.
	 * @param mixed $value The value to validate.
	 * @param array $errorMessages The error messages of the validation.
	 * @param bool $expectedSucceeded The success state of the validation.
	 * @dataProvider valuesAndResultsDataProvider
	 */
	public function testsProperValidation( string $flagableClassName, array $reflectedFlags, int $maxValue, $value, array $errorMessages, bool $expectedSucceeded ): void
	{
		$flagable = new $flagableClassName;

		$validator = new ValueValidator ();
		$validator->validate( $flagable, $reflectedFlags, $maxValue, $value );

		$this->assertEquals( $errorMessages, $validator->getErrorMessages() );
		$this->assertEquals( $expectedSucceeded, $validator->succeeded() );
	}

	/**
	 * Provides the data to validate a value.
	 * @return array The data sets.
	 */
	public function valuesAndResultsDataProvider(): array
	{
		return [
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => ValidPermissions::DIRECTORY,
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 'DIRECTORY',
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 'DIRECTORY|UREAD',
				'errorMessages'     => [],
				'expectedSucceeded' => true
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 'foobar',
				'errorMessages'     => [
					"The value 'foobar' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 'DIRECTORY|UEXECUTE',
				'errorMessages'     => [
					"The value 'UEXECUTE' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => -42,
				'errorMessages'     => [
					"Invalid type in value '-42'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => -42.5,
				'errorMessages'     => [
					"Invalid type in value '-42.5'. Unsigned 'int', 'string' or instance of 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => '-42',
				'errorMessages'     => [
					"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => '-42.5',
				'errorMessages'     => [
					"Invalid type in stringified value '-42.5'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 42,
				'errorMessages'     => [
					"The value '42' exceeds the maximum flag value of '7'.",
				],
				'expectedSucceeded' => false
			],
			[
				'flagableClassName' => ValidPermissions::class,
				'reflectedFlags'    => [
					'DIRECTORY' => 1,
					'UREAD'     => 2,
					'UWRITE'    => 4,
				],
				'maxValue'          => 7,
				'value'             => 'DIRECTORY|-42|UEXECUTE',
				'errorMessages'     => [
					"Invalid type in stringified value '-42'. Unsigned 'int' or flag name of flagable 'CodeKandis\Phlags\Tests\Fixtures\ValidPermissions' expected.",
					"The value 'UEXECUTE' cannot be resolved to a flag value.",
				],
				'expectedSucceeded' => false
			],
		];
	}
}
