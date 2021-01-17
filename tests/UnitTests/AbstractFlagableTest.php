<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\UnitTests;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
use CodeKandis\Phlags\FlagableInterface;
use CodeKandis\Phlags\Tests\Fixtures\InvalidFlagable;
use CodeKandis\Phlags\Tests\Fixtures\ValidFlagable;
use CodeKandis\Phlags\Validation\InvalidFlagableException;
use PHPUnit\Framework\TestCase;
use Throwable;

/**
 * Represents the test case for the class 'CodeKandis\Phlags\AbstractFlagable'.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
final class AbstractFlagableTest extends TestCase
{
	/**
	 * Provides flagables with unknown members and expected the data to validate unsupported operations.
	 * @return array The flagables with unknown members and expected the data to validate unsupported operations.
	 */
	public function flagablesWithUnknownMemberAndExceptionDataProvider(): array
	{
		return [
			0 => [
				'flagable'                   => new class() extends AbstractFlagable {
				},
				'unknownMemberName'          => 'foobar',
				'expectedExceptionClassName' => UnsupportedOperationException::class,
			]
		];
	}

	/**
	 * Tests if an exception will be thrown while accessing an unknown static method.
	 * @param AbstractFlagable $flagable The flagable to test.
	 * @param string $unknownMemberName The name of the unknown static method.
	 * @param string $expectedExceptionClassName The class name of the expected exception.
	 * @dataProvider flagablesWithUnknownMemberAndExceptionDataProvider
	 */
	public function testExceptionIsThrownWhileAccessingUnsupportedStaticMethod( AbstractFlagable $flagable, string $unknownMemberName, string $expectedExceptionClassName ): void
	{
		$this->expectException( $expectedExceptionClassName );
		$flagable::{$unknownMemberName}();
	}

	/**
	 * Tests if an exception will be thrown while accessing an unknown instance method.
	 * @param AbstractFlagable $flagable The flagable to test.
	 * @param string $unknownMemberName The name of the unknown instance method.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithUnknownMemberAndExceptionDataProvider
	 */
	public function testExceptionIsThrownWhileAccessingUnsupportedinstanceMethod( AbstractFlagable $flagable, string $unknownMemberName, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->{$unknownMemberName}();
	}

	/**
	 * Tests if an exception will be thrown while calling unset on an unknown member.
	 * @param AbstractFlagable $flagable The flagable to test.
	 * @param string $unknownMemberName The name of the unknown member.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithUnknownMemberAndExceptionDataProvider
	 */
	public function testExceptionIsThrownWhileCallingUnsetOnUnknownMember( AbstractFlagable $flagable, string $unknownMemberName, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		unset( $flagable->{$unknownMemberName} );
	}

	/**
	 * Tests if an exception will be thrown while getting the value of an unknown member.
	 * @param AbstractFlagable $flagable The flagable to test.
	 * @param string $unknownMemberName The name of the unknown member.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithUnknownMemberAndExceptionDataProvider
	 */
	public function testExceptionIsThrownWhileGettingValueOfUnknownMember( AbstractFlagable $flagable, string $unknownMemberName, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->{$unknownMemberName};
	}

	/**
	 * Tests if an exception will be thrown while setting the value of an unknown member.
	 * @param AbstractFlagable $flagable The flagable to test.
	 * @param string $unknownMemberName The name of the unknown member.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider flagablesWithUnknownMemberAndExceptionDataProvider
	 */
	public function testExceptionIsThrownWhileSettingValueOfUnknownMember( AbstractFlagable $flagable, string $unknownMemberName, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		$flagable->{$unknownMemberName} = 0;
	}

	public function invalidFlagablesWithFlagableValidationExceptionDataProvider(): array
	{
		return [
			0 => [
				'flagableClassName' => InvalidFlagable::class,
				'expectedException' => InvalidFlagableException::class
			]
		];
	}

	/**
	 * Tests if an exception will be thrown while instantiating an invalid flagable.
	 * @param string $flagableClassName The class name of the flagable to test.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider invalidFlagablesWithFlagableValidationExceptionDataProvider
	 */
	public function testInstantiationThrowsException( string $flagableClassName, string $expectedException ): void
	{
		$this->expectException( $expectedException );
		new $flagableClassName();
	}

	/**
	 * Tests if the stored exception will be thrown while instantiating an invalid flagable.
	 * @param string $flagableClassName The class name of the flagable to test.
	 * @param string $expectedException The class name of the expected exception.
	 * @dataProvider invalidFlagablesWithFlagableValidationExceptionDataProvider
	 */
	public function testInstantiationThrowsStoredException( string $flagableClassName, string $expectedException ): void
	{
		try
		{
			new $flagableClassName();
		}
		catch ( Throwable $exception )
		{
		}
		$this->expectException( $expectedException );
		new $flagableClassName();
	}

	/**
	 * Provides flagable class names with initial values and expected return values.
	 * @return array The flagable class names with initial values and expected return values.
	 */
	public function flagableClassNamesWithInitialValuesAndExpectedFlagValuesDataProvider(): array
	{
		return [
			0  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => ValidFlagable::NONE,
				'expectedFlagValue' => ValidFlagable::NONE
			],
			1  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => new ValidFlagable(),
				'expectedFlagValue' => ValidFlagable::NONE
			],
			2  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => '0',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			3  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => 'NONE',
				'expectedFlagValue' => ValidFlagable::NONE
			],
			4  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => ValidFlagable::FLAG_A,
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			5  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => new ValidFlagable( ValidFlagable::FLAG_A ),
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			6  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => '1',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			7  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => 'FLAG_A',
				'expectedFlagValue' => ValidFlagable::FLAG_A
			],
			8  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B,
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			9  => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => new ValidFlagable( ValidFlagable::FLAG_A | ValidFlagable::FLAG_B ),
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			10 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => '1|2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			11 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => 'FLAG_A|FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			12 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => '1|FLAG_B',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			13 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => 'FLAG_A|2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			],
			14 => [
				'flagableClassName' => ValidFlagable::class,
				'initialValue'      => '1|2',
				'expectedFlagValue' => ValidFlagable::FLAG_A | ValidFlagable::FLAG_B
			]
		];
	}

	/**
	 * Tests if the initial value will be returned correctly while instantiating an abstract flagable.
	 * @param string $flagableClassName The class name of the flagable to test.
	 * @param int|string|FlagableInterface $initialValue The initial flag value.
	 * @param int $expectedFlagValue The expected flag value.
	 * @dataProvider flagableClassNamesWithInitialValuesAndExpectedFlagValuesDataProvider
	 */
	public function testInstantiationWithInitialValueReturnsValueCorrectly( string $flagableClassName, $initialValue, int $expectedFlagValue ): void
	{
		/**
		 * @var AbstractFlagable $flagable
		 */
		$flagable          = new $flagableClassName( $initialValue );
		$returnedFlagValue = $flagable->getValue();

		static::assertSame( $expectedFlagValue, $returnedFlagValue );
	}
}
