<?php
declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Service\NumsHelper;
use Exception;
use PHPUnit\Framework\TestCase;

class NumsHelperTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function test_have_expected_generated_nums()
    {
        // _000_000_00 series
        self::assertEquals(10_000_000_00, NumsHelper::from(0));
        self::assertEquals(20_000_000_00, NumsHelper::from(10_000_000_00));
        // ...
        self::assertEquals(100_000_000_00, NumsHelper::from(90_000_000_00));
        self::assertEquals(110_000_000_00, NumsHelper::from(100_000_000_00));
        self::assertEquals(120_000_000_00, NumsHelper::from(110_000_000_00));
        // ...

        self::assertEquals(500_000_000_00, NumsHelper::from(490_000_000_00));
        self::assertEquals(510_000_000_00, NumsHelper::from(500_000_000_00));
        self::assertEquals(10_000_000_01, NumsHelper::from(510_000_000_00)); // 10_000_000_00 + 1
        // ...
        // ...

        // _000_000_01 series
        self::assertEquals(20_000_000_01, NumsHelper::from(10_000_000_01));
        // ...
        self::assertEquals(500_000_000_01, NumsHelper::from(490_000_000_01));
        self::assertEquals(510_000_000_01, NumsHelper::from(500_000_000_01));
        self::assertEquals(10_000_000_02, NumsHelper::from(510_000_000_01)); // 10_000_000_01 + 1
        // ...
        // ...

        // _000_000_99 series
        self::assertEquals(20_000_000_99, NumsHelper::from(10_000_000_99));
        //
        self::assertEquals(500_000_000_99, NumsHelper::from(490_000_000_99));
        self::assertEquals(510_000_000_99, NumsHelper::from(500_000_000_99));
        self::assertEquals(10_000_001_00, NumsHelper::from(510_000_000_99));

        // 999_999_99 series
        self::assertEquals(20_999_999_99, NumsHelper::from(10_999_999_99));
        // ..
        self::assertEquals(500_999_999_99, NumsHelper::from(490_999_999_99));
    }

    /**
     * This test will check the last round & it should throw exception when it exceeds upper limit
     * @throws Exception
     */
    public function test_throws_upper_limit_reached_exception()
    {
        self::expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Upper limit reached for unique 6 length alphanumeric.');
        NumsHelper::from(500_999_999_99);
    }
}
