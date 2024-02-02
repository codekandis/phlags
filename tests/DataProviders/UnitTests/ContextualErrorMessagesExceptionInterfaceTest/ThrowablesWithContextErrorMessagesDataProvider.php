<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\DataProviders\UnitTests\ContextualErrorMessagesExceptionInterfaceTest;

use CodeKandis\Phlags\Validation\InvalidFlagableException;
use CodeKandis\Phlags\Validation\InvalidValueException;
use CodeKandis\PhpUnit\DataProviderInterface;
use Override;

/**
 * Represents a data provider providing throwables with context error messages and expected context error messages.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ThrowablesWithContextErrorMessagesDataProvider implements DataProviderInterface
{
	/**
	 * @inheritDoc
	 */
	#[Override]
	public static function provideData(): iterable
	{
		return [
			0 => [
				'throwable'                    => new InvalidFlagableException(),
				'contextErrorMessages'         => $contextErrorMessages = [],
				'expectedContextErrorMessages' => $contextErrorMessages
			],
			1 => [
				'throwable'                    => new InvalidFlagableException(),
				'contextErrorMessages'         => $contextErrorMessages = [
					'foo',
					'bar'
				],
				'expectedContextErrorMessages' => $contextErrorMessages
			],
			2 => [
				'throwable'                    => new InvalidValueException(),
				'contextErrorMessages'         => $contextErrorMessages = [],
				'expectedContextErrorMessages' => $contextErrorMessages
			],
			3 => [
				'throwable'                    => new InvalidValueException(),
				'contextErrorMessages'         => $contextErrorMessages = [
					'foo',
					'bar'
				],
				'expectedContextErrorMessages' => $contextErrorMessages
			]
		];
	}
}
