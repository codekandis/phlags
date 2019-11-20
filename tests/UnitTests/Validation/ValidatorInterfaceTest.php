<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests\Validation;

use CodeKandis\Phlags\Validation\AbstractValidator;
use CodeKandis\Phlags\Validation\FlagableValidator;
use CodeKandis\Phlags\Validation\ValidatorInterface;
use CodeKandis\Phlags\Validation\ValueValidator;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\Validation\ValidatorInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidatorInterfaceTest extends TestCase
{
	/**
	 * Provides validators with error messages and success states.
	 * @return array The validators with error messages and success states.
	 */
	public function validatorsDataProvider(): array
	{
		return [
			0 => [
				'validatorClass'        => new class() extends AbstractValidator
				{
					protected $errorMessages = [
						'foobar',
						'barfoo'
					];
				},
				'expectedErrorMessages' => [
					'foobar',
					'barfoo'
				],
				'expectedSucceeded'     => false
			],
			1 => [
				'validatorClass'        => new class() extends AbstractValidator
				{
				},
				'expectedErrorMessages' => [],
				'expectedSucceeded'     => true
			],
			2 => [
				'validatorClass'        => new class() extends ValueValidator
				{
					protected $errorMessages = [
						'foobar',
						'barfoo'
					];
				},
				'expectedErrorMessages' => [
					'foobar',
					'barfoo'
				],
				'expectedSucceeded'     => false
			],
			3 => [
				'validatorClass'        => new class() extends ValueValidator
				{
				},
				'expectedErrorMessages' => [],
				'expectedSucceeded'     => true
			],
			4 => [
				'validatorClass'        => new class() extends FlagableValidator
				{
					protected $errorMessages = [
						'foobar',
						'barfoo'
					];
				},
				'expectedErrorMessages' => [
					'foobar',
					'barfoo'
				],
				'expectedSucceeded'     => false
			],
			5 => [
				'validatorClass'        => new class() extends FlagableValidator
				{
				},
				'expectedErrorMessages' => [],
				'expectedSucceeded'     => true
			]
		];
	}

	/**
	 * Tests if the validators return the error messages and the success state correctly.
	 * @param ValidatorInterface $validator The validator implementing `ValidatorInterface`.
	 * @param string[] $expectedErrorMessages The expected error messages.
	 * @param bool $expectedSucceeded The expected success state.
	 * @dataProvider validatorsDataProvider
	 */
	public function testValidatorsReturnResultsCorrectly( ValidatorInterface $validator, array $expectedErrorMessages, bool $expectedSucceeded ): void
	{
		$resultedErrorMessages = $validator->getErrorMessages();
		$resultedSucceeded     = $validator->succeeded();

		static::assertSame( $expectedErrorMessages, $resultedErrorMessages );
		static::assertSame( $expectedSucceeded, $resultedSucceeded );
	}
}
