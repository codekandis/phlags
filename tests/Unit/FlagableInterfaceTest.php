<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit;

use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use CodeKandis\Phlags\Validation\InvalidValueException;
use PHPUnit\Framework\TestCase;
use function iterator_to_array;

/**
 * Represents the test case for the interface `CodeKandis\Phlags\FlagableInterface`.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class FlagableInterfaceTest extends TestCase
{
	/**
	 * Provides initiated flagables with string representations.
	 * @return array The initiated flagables with string representations.
	 */
	public function initiatedFlagsWithStringRepresentationsDataProvider(): array
	{
		return [
			0 => [
				'flagable'                     => new ValidFlagable(),
				'expectedStringRepresentation' => 'NONE'
			],
			1 => [
				'flagable'                     => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedStringRepresentation' => 'FLAG_A'
			],
			2 => [
				'flagable'                     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_B'
			],
			3 => [
				'flagable'                     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_B|FLAG_C'
			],
			4 => [
				'flagable'                     => new ValidFlagable( ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_B|FLAG_C'
			],
			5 => [
				'flagable'                     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'expectedStringRepresentation' => 'FLAG_A|FLAG_C'
			]
		];
	}

	/**
	 * Tests if the string representation will be returned correctly while calling the method `toString()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param string $expectedStringRepresentation The expected string representation of the flagable.
	 * @dataProvider initiatedFlagsWithStringRepresentationsDataProvider
	 */
	public function testToStringReturnsStringRepresentationCorrectly( FlagableInterface $flagable, string $expectedStringRepresentation ): void
	{
		$resultedStringRepresentation = (string) $flagable;

		static::assertSame( $expectedStringRepresentation, $resultedStringRepresentation );
	}

	/**
	 * Provides initiated flagables with integer representations.
	 * @return array The initiated flagables with integer representations.
	 */
	public function initiatedFlagsWithIntegerRepresentationsDataProvider(): array
	{
		return [
			0 => [
				'flagable'     => new ValidFlagable( ValidFlagable::NONE ),
				'valueToCheck' => ValidFlagable::NONE
			],
			1 => [
				'flagable'     => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck' => ValidFlagable::FLAG_A
			],
			2 => [
				'flagable'     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			3 => [
				'flagable'     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			4 => [
				'flagable'     => new ValidFlagable( ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck' => ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			5 => [
				'flagable'     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'valueToCheck' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_C
			]
		];
	}

	/**
	 * Tests if the integer representation will be returned correctly while invoking the flagable.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int $valueToCheck The expected integer representation of the flagable.
	 * @dataProvider initiatedFlagsWithIntegerRepresentationsDataProvider
	 */
	public function testInvocationReturnsIntegerRepresentationCorrectly( FlagableInterface $flagable, int $valueToCheck ): void
	{
		$resultedIntegerRepresentation = $flagable();

		static::assertSame( $valueToCheck, $resultedIntegerRepresentation );
	}

	/**
	 * Tests if the integer representation will be returned correctly while calling the method `getValue()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int $valueToCheck The expected integer representation of the flagable.
	 * @dataProvider initiatedFlagsWithIntegerRepresentationsDataProvider
	 */
	public function testCallingGetValueReturnsIntegerRepresentationCorrectly( FlagableInterface $flagable, int $valueToCheck ): void
	{
		$resultedIntegerRepresentation = $flagable->getValue();

		static::assertSame( $valueToCheck, $resultedIntegerRepresentation );
	}

	/**
	 * Provides initiated flagables with integer representations.
	 * @return array The initiated flagables with integer representations.
	 */
	public function initiatedFlagsWithHasResultDataProvider(): array
	{
		return [
			0  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => ValidFlagable::NONE,
				'expectedHasReturnValue' => true
			],
			1  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => new ValidFlagable(),
				'expectedHasReturnValue' => true
			],
			2  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => '0',
				'expectedHasReturnValue' => true
			],
			3  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => 'NONE',
				'expectedHasReturnValue' => true
			],
			4  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => ValidFlagable::FLAG_A,
				'expectedHasReturnValue' => false
			],
			5  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => '1',
				'expectedHasReturnValue' => false
			],
			6  => [
				'flagable'               => new ValidFlagable(),
				'valueToCheck'           => 'FLAG_A',
				'expectedHasReturnValue' => false
			],
			7  => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => ValidFlagable::FLAG_A,
				'expectedHasReturnValue' => true
			],
			8  => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedHasReturnValue' => true
			],
			9  => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => '1',
				'expectedHasReturnValue' => true
			],
			10 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => 'FLAG_A',
				'expectedHasReturnValue' => true
			],
			11 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => ValidFlagable::FLAG_B,
				'expectedHasReturnValue' => false
			],
			12 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => '2',
				'expectedHasReturnValue' => false
			],
			13 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToCheck'           => 'FLAG_B',
				'expectedHasReturnValue' => false
			],
			14 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => ValidFlagable::FLAG_A,
				'expectedHasReturnValue' => true
			],
			15 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedHasReturnValue' => true
			],
			16 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '1',
				'expectedHasReturnValue' => true
			],
			17 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => 'FLAG_A',
				'expectedHasReturnValue' => true
			],
			18 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'expectedHasReturnValue' => true
			],
			19 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedHasReturnValue' => true
			],
			20 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '1|2',
				'expectedHasReturnValue' => true
			],
			21 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => 'FLAG_A|FLAG_B',
				'expectedHasReturnValue' => true
			],
			22 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '1|FLAG_B',
				'expectedHasReturnValue' => true
			],
			23 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => 'FLAG_A|2',
				'expectedHasReturnValue' => true
			],
			24 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '1|2',
				'expectedHasReturnValue' => true
			],
			25 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '3',
				'expectedHasReturnValue' => true
			],
			26 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => ValidFlagable::FLAG_C,
				'expectedHasReturnValue' => false
			],
			27 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => '4',
				'expectedHasReturnValue' => false
			],
			28 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToCheck'           => 'FLAG_C',
				'expectedHasReturnValue' => false
			],
			29 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => ValidFlagable::FLAG_A,
				'expectedHasReturnValue' => true
			],
			30 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedHasReturnValue' => true
			],
			31 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => '1',
				'expectedHasReturnValue' => true
			],
			32 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => 'FLAG_A',
				'expectedHasReturnValue' => true
			],
			33 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C,
				'expectedHasReturnValue' => true
			],
			34 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'expectedHasReturnValue' => true
			],
			35 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => '1|2|3',
				'expectedHasReturnValue' => true
			],
			36 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => 'FLAG_A|FLAG_B|FLAG_C',
				'expectedHasReturnValue' => true
			],
			37 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => '1|FLAG_B|FLAG_C',
				'expectedHasReturnValue' => true
			],
			38 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => 'FLAG_A|2|FLAG_C',
				'expectedHasReturnValue' => true
			],
			39 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => '1|2|FLAG_C',
				'expectedHasReturnValue' => true
			],
			40 => [
				'flagable'               => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'valueToCheck'           => '3|FLAG_C',
				'expectedHasReturnValue' => true
			]
		];
	}

	/**
	 * Tests if the expected value will be returned correctly while calling the method `has()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int|string|FlagableInterface $valueToCheck The expected return value.
	 * @param bool $expectedHasReturnValue The expected return value.
	 * @dataProvider initiatedFlagsWithHasResultDataProvider
	 */
	public function testHasReturnsIntegerRepresentationCorrectly( FlagableInterface $flagable, $valueToCheck, bool $expectedHasReturnValue ): void
	{
		$resultedHasReturnValue = $flagable->has( $valueToCheck );

		static::assertSame( $expectedHasReturnValue, $resultedHasReturnValue );
	}

	/**
	 * Provides initiated flagables with set values.
	 * @return array The initiated flagables with set values.
	 */
	public function initiatedFlagsWithSetValueDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => ValidFlagable::NONE,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			1  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => new ValidFlagable(),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			2  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '0',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			3  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'NONE',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			4  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			5  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			6  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			7  => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			8  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			9  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			10 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => '2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			11 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => 'FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			12 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => ValidFlagable::NONE,
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			13 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => new ValidFlagable( ValidFlagable::NONE ),
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			14 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => '0',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			15 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSet'        => 'NONE',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			16 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSet'        => ValidFlagable::FLAG_C,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			17 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_C ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			18 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSet'        => '4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			19 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSet'        => 'FLAG_C',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			20 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'valueToSet'        => ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			21 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			22 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'valueToSet'        => '2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			23 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'valueToSet'        => 'FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			24 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			25 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			26 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1|2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			27 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			28 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1|FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			29 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			30 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			31 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			32 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1|2|4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			33 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|FLAG_B|FLAG_C',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			34 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1|FLAG_B|FLAG_C',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			35 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|2|FLAG_C',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			36 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|FLAG_B|4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			37 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => '1|FLAG_B|4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			38 => [
				'flagable'          => new ValidFlagable(),
				'valueToSet'        => 'FLAG_A|2|4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			]
		];
	}

	/**
	 * Tests if the expected value will be returned correctly while calling the method `has()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int|string|FlagableInterface $valueToSet The value to set.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedFlagsWithSetValueDataProvider
	 */
	public function testSetSetsValueCorrectly( FlagableInterface $flagable, $valueToSet, int $expectedFlagValue ): void
	{
		$flagable->set( $valueToSet );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Provides initiated flagables with unset values.
	 * @return array The initiated flagables with unset values.
	 */
	public function initiatedFlagsWithUnsetValueDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => ValidFlagable::NONE,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			1  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => new ValidFlagable( ValidFlagable::NONE ),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			2  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => '0',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			3  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => 'NONE',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			4  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToUnset'      => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			5  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			6  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => '1',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			7  => [
				'flagable'          => new ValidFlagable(),
				'valueToUnset'      => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			8  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			9  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			10 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => '1',
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			11 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			12 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			13 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			14 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => '1|2',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			15 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToUnset'      => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagable::NONE
			],
		];
	}

	/**
	 * Tests if the expected value will be returned correctly while calling the method `unset()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int|string|FlagableInterface $valueToUnset The value to unset.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedFlagsWithUnsetValueDataProvider
	 */
	public function testUnsetSetsValueCorrectly( FlagableInterface $flagable, $valueToUnset, int $expectedFlagValue ): void
	{
		$flagable->unset( $valueToUnset );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Provides initiated flagables with switch values.
	 * @return array The initiated flagables with switch values.
	 */
	public function initiatedFlagsWithSwitchValueDataProvider(): array
	{
		return [
			0  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => ValidFlagable::NONE,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			1  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => new ValidFlagable( ValidFlagable::NONE ),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			2  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => '0',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			3  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => 'NONE',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			4  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => '1|FLAG_B|4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			5  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'valueToSwitch'     => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			6  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			7  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => '1',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			8  => [
				'flagable'          => new ValidFlagable(),
				'valueToSwitch'     => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			9  => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			10 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			11 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => '1',
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			12 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::FLAG_B
			],
			13 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			14 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			15 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => '1|2',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			16 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			17 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => ValidFlagable::FLAG_C,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			18 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => new ValidFlagable( ValidFlagable::FLAG_C ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			19 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => '4',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
			20 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'valueToSwitch'     => 'FLAG_C',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C
			],
		];
	}

	/**
	 * Tests if the expected value will be returned correctly while calling the method `switch()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param int|string|FlagableInterface $valueToSwitch The value to switch.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider initiatedFlagsWithSwitchValueDataProvider
	 */
	public function testSwitchSetsValueCorrectly( FlagableInterface $flagable, $valueToSwitch, int $expectedFlagValue ): void
	{
		$flagable->switch( $valueToSwitch );
		$resultedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $resultedFlagValue );
	}

	/**
	 * Provides flagables with invalid values for manipulation and value validation exceptions.
	 * @return array The flagables with invalid values for manipulation and value validation exceptions.
	 */
	public function flagablesWithInvalidValuesAndValueValidationExceptionDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => -1,
				'expectedException' => InvalidValueException::class
			],
			1 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => -42,
				'expectedException' => InvalidValueException::class
			],
			2 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => 42,
				'expectedException' => InvalidValueException::class
			],
			3 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => '-42',
				'expectedException' => InvalidValueException::class
			],
			4 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => '42',
				'expectedException' => InvalidValueException::class
			],
			5 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => 'FLAG_D',
				'expectedException' => InvalidValueException::class
			],
			6 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => 'FLAG_A|FLAG_D',
				'expectedException' => InvalidValueException::class
			],
			7 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => 'FLAG_A|-42',
				'expectedException' => InvalidValueException::class
			],
			8 => [
				'flagableClassName' => new ValidFlagable(),
				'valueToManipulate' => 'FLAG_A|42',
				'expectedException' => InvalidValueException::class
			]
		];
	}

	/**
	 * Tests if an exception will be thrown while setting an invalid flagable.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param mixed The value to set.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithInvalidValuesAndValueValidationExceptionDataProvider
	 */
	public function testSettingInvalidValueThrowsException( FlagableInterface $flagable, $valueToManipulate, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->set( $valueToManipulate );
	}

	/**
	 * Tests if an exception will be thrown while unsetting an invalid flagable.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param mixed The value to unset.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithInvalidValuesAndValueValidationExceptionDataProvider
	 */
	public function testUnsettingInvalidValueThrowsException( FlagableInterface $flagable, $valueToManipulate, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->unset( $valueToManipulate );
	}

	/**
	 * Tests if an exception will be thrown while switching an invalid flagable.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param mixed The value to switch.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithInvalidValuesAndValueValidationExceptionDataProvider
	 */
	public function testSwitchingInvalidValueThrowsException( FlagableInterface $flagable, $valueToManipulate, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->switch( $valueToManipulate );
	}

	/**
	 * Provides flagables with a list of flags to iterate.
	 * @return array The flagables with a list of flags to iterate.
	 */
	public function flagablesWithFlagListDataProvider(): array
	{
		return [
			0 => [
				'flagable'          => new ValidFlagable(),
				'expectedFlagables' => [
					new ValidFlagable()
				]
			],
			1 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagables' => [
					new ValidFlagable( ValidFlagable::FLAG_A )
				]
			],
			2 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_B ),
				'expectedFlagables' => [
					new ValidFlagable( ValidFlagable::FLAG_B )
				]
			],
			3 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedFlagables' => [
					new ValidFlagable( ValidFlagable::FLAG_A ),
					new ValidFlagable( ValidFlagable::FLAG_B )
				]
			],
			4 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_C ),
				'expectedFlagables' => [
					new ValidFlagable( ValidFlagable::FLAG_A ),
					new ValidFlagable( ValidFlagable::FLAG_C )
				]
			],
			5 => [
				'flagable'          => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B | ValidFlagable::FLAG_C ),
				'expectedFlagables' => [
					new ValidFlagable( ValidFlagable::FLAG_A ),
					new ValidFlagable( ValidFlagable::FLAG_B ),
					new ValidFlagable( ValidFlagable::FLAG_C )
				]
			]
		];
	}

	/**
	 * Tests if the expected list of flagables will be returned correctly while calling the method `getIterator()`.
	 * @param FlagableInterface $flagable The flagable to test.
	 * @param FlagableInterface[] $expectedFlagables The list of expected flagables.
	 * @dataProvider flagablesWithFlagListDataProvider
	 */
	public function testGetIteratorReturnsListOfAllSetFlags( FlagableInterface $flagable, array $expectedFlagables ): void
	{
		$resultedFlagables = iterator_to_array( $flagable->getIterator(), false );

		static::assertEquals( $expectedFlagables, $resultedFlagables );
	}
}
