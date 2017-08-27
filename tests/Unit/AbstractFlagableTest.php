<?php declare( strict_types = 1 );

namespace CodeKandis\Phlags\Tests
{

    use CodeKandis\Phlags\AbstractFlagable;
    use CodeKandis\Phlags\Exceptions\InvalidValueException;
    use CodeKandis\Phlags\Exceptions\UnsupportedOperationException;
    use CodeKandis\Phlags\Tests\Fixtures\ValidPermissions;
    use PHPUnit\Framework\TestCase;

    /**
     * Represents the test case for the class 'CodeKandis\Phlags\AbstractFlagable'.
     * @package codekandis\phlags
     * @author  Christian Ramelow <info@codekandis.net>
     */
    final class AbstractFlagableTest extends TestCase
    {
        /**
         * Tests if the flagable is working as expected.
         * @param string $flagableClassName The class name of the flagable to instantiate.
         * @param int    $initialValue      The initial value of the flagable.
         * @param int    $setValue_1        The first value to set.
         * @param int    $setResult_1       The flagable value after the first set.
         * @param int    $hasValue_1        The first value to check if it is set.
         * @param int    $hasValue_2        The second value to check if it is set.
         * @param int    $setValue_2        The second value to set.
         * @param int    $setResult_2       The flagable value after the second set.
         * @param int    $hasValue_3        The third value to check if it is set.
         * @param int    $hasValue_4        The fourth value to check if it is set.
         * @param int    $hasValue_5        The fifth value to check if it is set.
         * @param int    $notHasValue_1     The first value to check if it is not set.
         * @param int    $unsetValue        The value to unset.
         * @param int    $unsetResult       The flagable value after the unset.
         * @param int    $hasValue_6        The sixth value to check if it is set.
         * @param int    $hasValue_7        The seventh value to check if it is set.
         * @param int    $notHasValue_2     The second value to check if it is not set.
         * @param int    $switchValue_1     The first value to switch.
         * @param int    $switchResult_1    The flagable value after the first switch.
         * @param int    $switchValue_2     The second value to switch.
         * @param int    $switchResult_2    The flagable value after the second switch.
         * @dataProvider abstractFlagableDataProvider
         */
        public function testsAllMethods(
            string $flagableClassName,
            int $initialValue,
            int $setValue_1,
            int $setResult_1,
            int $hasValue_1,
            int $hasValue_2,
            int $setValue_2,
            int $setResult_2,
            int $hasValue_3,
            int $hasValue_4,
            int $hasValue_5,
            int $notHasValue_1,
            int $unsetValue,
            int $unsetResult,
            int $hasValue_6,
            int $hasValue_7,
            int $notHasValue_2,
            int $switchValue_1,
            int $switchResult_1,
            int $switchValue_2,
            int $switchResult_2
        ): void
        {
            /* @var AbstractFlagable $flagable */
            $flagable = new $flagableClassName( $initialValue );
            $this->assertEquals( $initialValue, $flagable() );
            $this->assertEquals( $initialValue, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $initialValue ) );
            $flagable->set( $setValue_1 );
            $this->assertEquals( $setResult_1, $flagable() );
            $this->assertEquals( $setResult_1, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $setResult_1 ) );
            $this->assertTrue( $flagable->has( $hasValue_1 ) );
            $this->assertTrue( $flagable->has( $hasValue_2 ) );
            $flagable->set( $setValue_2 );
            $this->assertEquals( $setResult_2, $flagable() );
            $this->assertEquals( $setResult_2, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $setResult_2 ) );
            $this->assertTrue( $flagable->has( $hasValue_3 ) );
            $this->assertTrue( $flagable->has( $hasValue_4 ) );
            $this->assertTrue( $flagable->has( $hasValue_5 ) );
            $this->assertFalse( $flagable->has( $notHasValue_1 ) );
            $flagable->unset( $unsetValue );
            $this->assertEquals( $unsetResult, $flagable() );
            $this->assertEquals( $unsetResult, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $unsetResult ) );
            $this->assertTrue( $flagable->has( $hasValue_6 ) );
            $this->assertTrue( $flagable->has( $hasValue_7 ) );
            $this->assertFalse( $flagable->has( $notHasValue_2 ) );
            $flagable->switch( $switchValue_1 );
            $this->assertEquals( $switchResult_1, $flagable() );
            $this->assertEquals( $switchResult_1, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $switchResult_1 ) );
            $flagable->switch( $switchValue_2 );
            $this->assertEquals( $switchResult_2, $flagable() );
            $this->assertEquals( $switchResult_2, $flagable->getValue() );
            $this->assertTrue( $flagable->has( $switchResult_2 ) );
        }

        /**
         * Provides the data sets with method arguments.
         * @return array The data sets.
         */
        public function abstractFlagableDataProvider(): array
        {
            return [
                [
                    'flagableClassName' => ValidPermissions::class,
                    'initialValue'      => ValidPermissions::NONE,
                    'setValue_1'        => ValidPermissions::DIRECTORY,
                    'setResult_1'       => ValidPermissions::DIRECTORY,
                    'hasValue_1'        => ValidPermissions::NONE,
                    'hasValue_2'        => ValidPermissions::DIRECTORY,
                    'setValue_2'        => ValidPermissions::UREAD,
                    'setResult_2'       => ValidPermissions::DIRECTORY | ValidPermissions::UREAD,
                    'hasValue_3'        => ValidPermissions::NONE,
                    'hasValue_4'        => ValidPermissions::DIRECTORY,
                    'hasValue_5'        => ValidPermissions::UREAD,
                    'notHasValue_1'     => ValidPermissions::UWRITE,
                    'unsetValue'        => ValidPermissions::DIRECTORY,
                    'unsetResult'       => ValidPermissions::UREAD,
                    'hasValue_6'        => ValidPermissions::NONE,
                    'hasValue_7'        => ValidPermissions::UREAD,
                    'notHasValue_2'     => ValidPermissions::DIRECTORY,
                    'switchValue_1'     => ValidPermissions::UWRITE,
                    'switchResult_1'    => ValidPermissions::UREAD | ValidPermissions::UWRITE,
                    'switchValue_2'     => ValidPermissions::UWRITE,
                    'switchResult_2'    => ValidPermissions::UREAD,
                ],
            ];
        }

        /**
         * Test if unsupported operations will throw an exception.
         * @param string $flagableClassName  The class name of the flagable to test.
         * @param string $memberName         The name of the undefined member.
         * @param string $exceptionClassName The class name of the expected exception.
         * @dataProvider unsupportedOperationsDataProvider
         */
        public function testsUnsupportedOperations(
            string $flagableClassName,
            string $memberName,
            string $exceptionClassName
        ): void
        {
            $this->expectException( $exceptionClassName );
            $flagableClassName::$memberName();
            $flagable = new $flagableClassName();
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
                [
                    'flagableClassName'  => ValidPermissions::class,
                    'memberName'         => 'foobar',
                    'exceptionClassName' => UnsupportedOperationException::class,
                ],
            ];
        }
    }
}