<?php
declare(strict_types=1);

namespace Tests\Unit\Service;

use App\Service\Bijective;
use App\Service\NumsHelper;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;

class BijectiveTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function test_it_can_generate_6_chars_alphanumeric()
    {
        $str = (new Bijective())->encode(NumsHelper::from(0));
        self::assertTrue(boolval(preg_match('/[a-zA-Z0-9]{6}/', $str)));
    }

    /**
     * @throws \Exception
     */
    public function test_it_can_decode_back_to_given_num()
    {
        $num = NumsHelper::from(0);
        $b = new Bijective();
        $str = $b->encode($num);
        assertEquals($num, $b->decode($str));
    }

    /**
     * A random snapshot to verify generated strings length
     * @throws \Exception
     */
    public function test_first_500_generated_strings_are_6_chars_alphanumeric()
    {
        $n = 0;
        $b = new Bijective();
        $i = 0;
        while ($i < 500) {
            $n = NumsHelper::from($n);
            $str = $b->encode($n);
            self::assertTrue(boolval(preg_match('/[a-zA-Z0-9]{6}/', $str)));
            $i += 1;
        }
    }

    /**
     * Verify uniqueness for a random snapshot (say first 500 entries)
     * @throws \Exception
     */
    public function test_first_generated_string_is_unique_for_following_500_entries()
    {
        $n = 0;
        $b = new Bijective();
        $n = NumsHelper::from($n);
        $firstStr = $b->encode($n);

        $i = 0;
        while ($i <= 500) {
            $n = NumsHelper::from($n);
            $str = $b->encode($n);
            self::assertNotEquals($firstStr, $str);
            $i += 1;
        }
    }

    /**
     * @throws \Exception
     */
    public function test_it_can_generate_6_chars_alphanumeric_for_maximum_limit_of_500_999_999_99()
    {
        $num = NumsHelper::from(490_999_999_99);

        $str = (new Bijective())->encode($num);
        self::assertTrue(boolval(preg_match('/[a-zA-Z0-9]{6}/', $str)));
    }
}
