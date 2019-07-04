<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use PHPUnit\Framework\TestCase;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\AbstractFlagable'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class AbstractFlagableTest extends TestCase
{
	/**
	 * Tests if the flagable is working as expected.
	 * @param string $flagableClassName The class name of the flagable to instantiate.
	 * @param int|string|FlagableInterface $initialValue The initial value of the flagable.
	 * @param int $initialResult The flagable value after the instantiation.
	 * @param string $string_1 The first string representation of the flagable.
	 * @param int|string|FlagableInterface $setValue_1 The first value to set.
	 * @param int $setResult_1 The flagable value after the first set.
	 * @param string $string_2 The second string representation of the flagable.
	 * @param int|string|FlagableInterface $hasValue_1 The first value to check if it is set.
	 * @param int|string|FlagableInterface $hasValue_2 The second value to check if it is set.
	 * @param int|string|FlagableInterface $setValue_2 The second value to set.
	 * @param int $setResult_2 The flagable value after the second set.
	 * @param string $string_3 The third string representation of the flagable.
	 * @param int|string|FlagableInterface $hasValue_3 The third value to check if it is set.
	 * @param int|string|FlagableInterface $hasValue_4 The fourth value to check if it is set.
	 * @param int|string|FlagableInterface $hasValue_5 The fifth value to check if it is set.
	 * @param int|string|FlagableInterface $notHasValue_1 The first value to check if it is not set.
	 * @param int|string|FlagableInterface $unsetValue The value to unset.
	 * @param int $unsetResult The flagable value after the unset.
	 * @param string $string_4 The fourth string representation of the flagable.
	 * @param int|string|FlagableInterface $hasValue_6 The sixth value to check if it is set.
	 * @param int|string|FlagableInterface $hasValue_7 The seventh value to check if it is set.
	 * @param int|string|FlagableInterface $notHasValue_2 The second value to check if it is not set.
	 * @param int|string|FlagableInterface $switchValue_1 The first value to switch.
	 * @param int $switchResult_1 The flagable value after the first switch.
	 * @param string $string_5 The fifth string representation of the flagable.
	 * @param int|string|FlagableInterface $switchValue_2 The second value to switch.
	 * @param int $switchResult_2 The flagable value after the second switch.
	 * @param string $string_6 The sixth string representation of the flagable.
	 * @dataProvider abstractFlagableDataProvider
	 */
	public function testsAllMethods( string $flagableClassName, $initialValue, int $initialResult, string $string_1, $setValue_1, int $setResult_1, string $string_2, $hasValue_1, $hasValue_2, $setValue_2, int $setResult_2, string $string_3, $hasValue_3, $hasValue_4, $hasValue_5, $notHasValue_1, $unsetValue, int $unsetResult, string $string_4, $hasValue_6, $hasValue_7, $notHasValue_2, $switchValue_1, int $switchResult_1, string $string_5, $switchValue_2, int $switchResult_2, string $string_6 ): void
	{
		/**
		 * @var AbstractFlagable $flagable
		 */
		$flagable = new $flagableClassName( $initialValue );

		static::assertEquals( $initialResult, $flagable() );
		static::assertEquals( $initialResult, $flagable->getValue() );
		static::assertTrue( $flagable->has( $initialResult ) );
		static::assertEquals( $string_1, $flagable->__toString() );

		$flagable->set( $setValue_1 );

		static::assertEquals( $setResult_1, $flagable() );
		static::assertEquals( $setResult_1, $flagable->getValue() );
		static::assertTrue( $flagable->has( $setResult_1 ) );
		static::assertTrue( $flagable->has( $hasValue_1 ) );
		static::assertTrue( $flagable->has( $hasValue_2 ) );
		static::assertEquals( $string_2, $flagable->__toString() );

		$flagable->set( $setValue_2 );

		static::assertEquals( $setResult_2, $flagable() );
		static::assertEquals( $setResult_2, $flagable->getValue() );
		static::assertTrue( $flagable->has( $setResult_2 ) );
		static::assertTrue( $flagable->has( $hasValue_3 ) );
		static::assertTrue( $flagable->has( $hasValue_4 ) );
		static::assertTrue( $flagable->has( $hasValue_5 ) );
		static::assertFalse( $flagable->has( $notHasValue_1 ) );
		static::assertEquals( $string_3, $flagable->__toString() );

		$flagable->unset( $unsetValue );

		static::assertEquals( $unsetResult, $flagable() );
		static::assertEquals( $unsetResult, $flagable->getValue() );
		static::assertTrue( $flagable->has( $unsetResult ) );
		static::assertTrue( $flagable->has( $hasValue_6 ) );
		static::assertTrue( $flagable->has( $hasValue_7 ) );
		static::assertFalse( $flagable->has( $notHasValue_2 ) );
		static::assertEquals( $string_4, $flagable->__toString() );

		$flagable->switch( $switchValue_1 );

		static::assertEquals( $switchResult_1, $flagable() );
		static::assertEquals( $switchResult_1, $flagable->getValue() );
		static::assertTrue( $flagable->has( $switchResult_1 ) );
		static::assertEquals( $string_5, $flagable->__toString() );

		$flagable->switch( $switchValue_2 );

		static::assertEquals( $switchResult_2, $flagable() );
		static::assertEquals( $switchResult_2, $flagable->getValue() );
		static::assertTrue( $flagable->has( $switchResult_2 ) );
		static::assertEquals( $string_6, $flagable->__toString() );
	}

	/**
	 * Provides the data sets with method arguments.
	 * @return array The data sets.
	 */
	public function abstractFlagableDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => ValidFlagable::NONE,
				'initialResult'     => ValidFlagable::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => ValidFlagable::FLAG_A,
				'setResult_1'       => ValidFlagable::FLAG_A,
				'string_2'          => 'FLAG_A',
				'hasValue_1'        => ValidFlagable::NONE,
				'hasValue_2'        => ValidFlagable::FLAG_A,
				'setValue_2'        => ValidFlagable::FLAG_B,
				'setResult_2'       => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'string_3'          => 'FLAG_A|FLAG_B',
				'hasValue_3'        => ValidFlagable::NONE,
				'hasValue_4'        => ValidFlagable::FLAG_A,
				'hasValue_5'        => ValidFlagable::FLAG_B,
				'notHasValue_1'     => ValidFlagable::FLAG_C,
				'unsetValue'        => ValidFlagable::FLAG_A,
				'unsetResult'       => ValidFlagable::FLAG_B,
				'string_4'          => 'FLAG_B',
				'hasValue_6'        => ValidFlagable::NONE,
				'hasValue_7'        => ValidFlagable::FLAG_B,
				'notHasValue_2'     => ValidFlagable::FLAG_A,
				'switchValue_1'     => ValidFlagable::FLAG_C,
				'switchResult_1'    => ValidFlagable::FLAG_B | ValidFlagable::FLAG_C,
				'string_5'          => 'FLAG_B|FLAG_C',
				'switchValue_2'     => ValidFlagable::FLAG_C,
				'switchResult_2'    => ValidFlagable::FLAG_B,
				'string_6'          => 'FLAG_B',
			],
			1 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => new ValidFlagable( ValidFlagable::NONE ),
				'initialResult'     => ValidFlagable::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => new ValidFlagable( ValidFlagable::FLAG_A ),
				'setResult_1'       => ValidFlagable::FLAG_A,
				'string_2'          => 'FLAG_A',
				'hasValue_1'        => new ValidFlagable( ValidFlagable::NONE ),
				'hasValue_2'        => new ValidFlagable( ValidFlagable::FLAG_A ),
				'setValue_2'        => new ValidFlagable( ValidFlagable::FLAG_B ),
				'setResult_2'       => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'string_3'          => 'FLAG_A|FLAG_B',
				'hasValue_3'        => new ValidFlagable( ValidFlagable::NONE ),
				'hasValue_4'        => new ValidFlagable( ValidFlagable::FLAG_A ),
				'hasValue_5'        => new ValidFlagable( ValidFlagable::FLAG_B ),
				'notHasValue_1'     => new ValidFlagable( ValidFlagable::FLAG_C ),
				'unsetValue'        => new ValidFlagable( ValidFlagable::FLAG_A ),
				'unsetResult'       => ValidFlagable::FLAG_B,
				'string_4'          => 'FLAG_B',
				'hasValue_6'        => new ValidFlagable( ValidFlagable::NONE ),
				'hasValue_7'        => new ValidFlagable( ValidFlagable::FLAG_B ),
				'notHasValue_2'     => new ValidFlagable( ValidFlagable::FLAG_A ),
				'switchValue_1'     => new ValidFlagable( ValidFlagable::FLAG_C ),
				'switchResult_1'    => ValidFlagable::FLAG_B | ValidFlagable::FLAG_C,
				'string_5'          => 'FLAG_B|FLAG_C',
				'switchValue_2'     => new ValidFlagable( ValidFlagable::FLAG_C ),
				'switchResult_2'    => ValidFlagable::FLAG_B,
				'string_6'          => 'FLAG_B',
			],
			2 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => 'NONE',
				'initialResult'     => ValidFlagable::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => 'FLAG_A',
				'setResult_1'       => ValidFlagable::FLAG_A,
				'string_2'          => 'FLAG_A',
				'hasValue_1'        => 'NONE',
				'hasValue_2'        => 'FLAG_A',
				'setValue_2'        => 'FLAG_B',
				'setResult_2'       => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'string_3'          => 'FLAG_A|FLAG_B',
				'hasValue_3'        => 'NONE',
				'hasValue_4'        => 'FLAG_A',
				'hasValue_5'        => 'FLAG_B',
				'notHasValue_1'     => 'FLAG_C',
				'unsetValue'        => 'FLAG_A',
				'unsetResult'       => ValidFlagable::FLAG_B,
				'string_4'          => 'FLAG_B',
				'hasValue_6'        => 'NONE',
				'hasValue_7'        => 'FLAG_B',
				'notHasValue_2'     => 'FLAG_A',
				'switchValue_1'     => 'FLAG_C',
				'switchResult_1'    => ValidFlagable::FLAG_B | ValidFlagable::FLAG_C,
				'string_5'          => 'FLAG_B|FLAG_C',
				'switchValue_2'     => 'FLAG_C',
				'switchResult_2'    => ValidFlagable::FLAG_B,
				'string_6'          => 'FLAG_B',
			]
		];
	}

	/**
	 * Test if unsupported operations will throw an exception.
	 * @param string $flagableClassName The class name of the flagable to test.
	 * @param string $memberName The name of the undefined member.
	 * @param string $exceptionClassName The class name of the expected exception.
	 * @dataProvider unsupportedOperationsDataProvider
	 */
	public function testsUnsupportedOperations( string $flagableClassName, string $memberName, string $exceptionClassName ): void
	{
		$this->expectException( $exceptionClassName );
		$flagableClassName::$memberName();
		$flagable = new $flagableClassName;
		$flagable->$memberName();
		isset( $flagable->$memberName );
		unset( $flagable->$memberName );
		$flagable->$memberName;
		$flagable->$memberName = 0;
	}

	/**
	 * Provides the data to validate unsuppoted operations.
	 * @return array The data sets.
	 */
	public function unsupportedOperationsDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName'  => ValidFlagable::class,
				'memberName'         => 'foobar',
				'exceptionClassName' => UnsupportedOperationException::class,
			]
		];
	}

	/**
	 * Tests if iterating a flagable returns a generated list of flagables each one initialized with a flag set in the iterated flagable.
	 * @param string $flagableClassName The class name of the flagable to test.
	 * @param array $flags The flags of the initialization of the flagable and to expect after the iteration.
	 * @dataProvider iteratedFlagsDataProvider
	 */
	public function testsIteration( string $flagableClassName, array $flags ): void
	{
		/**
		 * @var FlagableInterface $flagableClassName
		 */
		$initialValue = $flagableClassName::NONE;
		/**
		 * @var int $flag
		 */
		foreach ( $flags as $flag )
		{
			$initialValue |= $flag;
		}
		$flagable      = new $flagableClassName( $initialValue );
		$iteratedFlags = [];
		/**
		 * @var FlagableInterface $iteratedFlag
		 */
		foreach ( $flagable as $iteratedFlag )
		{
			static::assertInstanceOf( $flagableClassName, $iteratedFlag );
			$iteratedFlags[] = $iteratedFlag->getValue();
		}
		static::assertEquals( $flags, $iteratedFlags );
	}

	/**
	 * Provides the data to test the iteration of flags.
	 * @return array The data sets.
	 */
	public function iteratedFlagsDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_A,
				]
			],
			1 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_A,
					ValidFlagable::FLAG_B,
				]
			],
			2 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_A,
					ValidFlagable::FLAG_B,
					ValidFlagable::FLAG_C,
				]
			],
			3 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_A,
					ValidFlagable::FLAG_B,
					ValidFlagable::FLAG_C,
				]
			],
			4 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_B,
					ValidFlagable::FLAG_C,
				]
			],
			5 => [
				'flagableClassName' => ValidFlagable::class,
				'flags'             => [
					ValidFlagable::FLAG_A,
					ValidFlagable::FLAG_C,
				],
			]
		];
	}
}
