<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Unit;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
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
				'flagableClassName' => ValidPermissions::class,
				'initialValue'      => ValidPermissions::NONE,
				'initialResult'     => ValidPermissions::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => ValidPermissions::DIRECTORY,
				'setResult_1'       => ValidPermissions::DIRECTORY,
				'string_2'          => 'DIRECTORY',
				'hasValue_1'        => ValidPermissions::NONE,
				'hasValue_2'        => ValidPermissions::DIRECTORY,
				'setValue_2'        => ValidPermissions::UREAD,
				'setResult_2'       => ValidPermissions::DIRECTORY | ValidPermissions::UREAD,
				'string_3'          => 'DIRECTORY|UREAD',
				'hasValue_3'        => ValidPermissions::NONE,
				'hasValue_4'        => ValidPermissions::DIRECTORY,
				'hasValue_5'        => ValidPermissions::UREAD,
				'notHasValue_1'     => ValidPermissions::UWRITE,
				'unsetValue'        => ValidPermissions::DIRECTORY,
				'unsetResult'       => ValidPermissions::UREAD,
				'string_4'          => 'UREAD',
				'hasValue_6'        => ValidPermissions::NONE,
				'hasValue_7'        => ValidPermissions::UREAD,
				'notHasValue_2'     => ValidPermissions::DIRECTORY,
				'switchValue_1'     => ValidPermissions::UWRITE,
				'switchResult_1'    => ValidPermissions::UREAD | ValidPermissions::UWRITE,
				'string_5'          => 'UREAD|UWRITE',
				'switchValue_2'     => ValidPermissions::UWRITE,
				'switchResult_2'    => ValidPermissions::UREAD,
				'string_6'          => 'UREAD',
			],
			1 => [
				'flagableClassName' => ValidPermissions::class,
				'initialValue'      => new ValidPermissions( ValidPermissions::NONE ),
				'initialResult'     => ValidPermissions::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'setResult_1'       => ValidPermissions::DIRECTORY,
				'string_2'          => 'DIRECTORY',
				'hasValue_1'        => new ValidPermissions( ValidPermissions::NONE ),
				'hasValue_2'        => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'setValue_2'        => new ValidPermissions( ValidPermissions::UREAD ),
				'setResult_2'       => ValidPermissions::DIRECTORY | ValidPermissions::UREAD,
				'string_3'          => 'DIRECTORY|UREAD',
				'hasValue_3'        => new ValidPermissions( ValidPermissions::NONE ),
				'hasValue_4'        => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'hasValue_5'        => new ValidPermissions( ValidPermissions::UREAD ),
				'notHasValue_1'     => new ValidPermissions( ValidPermissions::UWRITE ),
				'unsetValue'        => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'unsetResult'       => ValidPermissions::UREAD,
				'string_4'          => 'UREAD',
				'hasValue_6'        => new ValidPermissions( ValidPermissions::NONE ),
				'hasValue_7'        => new ValidPermissions( ValidPermissions::UREAD ),
				'notHasValue_2'     => new ValidPermissions( ValidPermissions::DIRECTORY ),
				'switchValue_1'     => new ValidPermissions( ValidPermissions::UWRITE ),
				'switchResult_1'    => ValidPermissions::UREAD | ValidPermissions::UWRITE,
				'string_5'          => 'UREAD|UWRITE',
				'switchValue_2'     => new ValidPermissions( ValidPermissions::UWRITE ),
				'switchResult_2'    => ValidPermissions::UREAD,
				'string_6'          => 'UREAD',
			],
			2 => [
				'flagableClassName' => ValidPermissions::class,
				'initialValue'      => 'NONE',
				'initialResult'     => ValidPermissions::NONE,
				'string_1'          => 'NONE',
				'setValue_1'        => 'DIRECTORY',
				'setResult_1'       => ValidPermissions::DIRECTORY,
				'string_2'          => 'DIRECTORY',
				'hasValue_1'        => 'NONE',
				'hasValue_2'        => 'DIRECTORY',
				'setValue_2'        => 'UREAD',
				'setResult_2'       => ValidPermissions::DIRECTORY | ValidPermissions::UREAD,
				'string_3'          => 'DIRECTORY|UREAD',
				'hasValue_3'        => 'NONE',
				'hasValue_4'        => 'DIRECTORY',
				'hasValue_5'        => 'UREAD',
				'notHasValue_1'     => 'UWRITE',
				'unsetValue'        => 'DIRECTORY',
				'unsetResult'       => ValidPermissions::UREAD,
				'string_4'          => 'UREAD',
				'hasValue_6'        => 'NONE',
				'hasValue_7'        => 'UREAD',
				'notHasValue_2'     => 'DIRECTORY',
				'switchValue_1'     => 'UWRITE',
				'switchResult_1'    => ValidPermissions::UREAD | ValidPermissions::UWRITE,
				'string_5'          => 'UREAD|UWRITE',
				'switchValue_2'     => 'UWRITE',
				'switchResult_2'    => ValidPermissions::UREAD,
				'string_6'          => 'UREAD',
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
				'flagableClassName'  => ValidPermissions::class,
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
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::DIRECTORY,
				]
			],
			1 => [
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::DIRECTORY,
					ValidPermissions::UREAD,
				]
			],
			2 => [
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::DIRECTORY,
					ValidPermissions::UREAD,
					ValidPermissions::UWRITE,
				]
			],
			3 => [
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::DIRECTORY,
					ValidPermissions::UREAD,
					ValidPermissions::UWRITE,
				]
			],
			4 => [
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::UREAD,
					ValidPermissions::UWRITE,
				]
			],
			5 => [
				'flagableClassName' => ValidPermissions::class,
				'flags'             => [
					ValidPermissions::DIRECTORY,
					ValidPermissions::UWRITE,
				]
			]
		];
	}
}
