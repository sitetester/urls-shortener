<?php
declare(strict_types=1);

namespace App\Service;

class NumsHelper
{
    // A safe number to generate random alphanumeric strings of length 6
    // Could be higher
    public const LIMIT = 510_999_999_99;

    /**
     * Rather than generating sequential values (1000000000, 1000000001, 1000000002, ...)
     * It'll generate a new number (each time) incremented by a step of 1000000000
     * This is to bring more randomness for generated strings, as sequentially generated strings are easier to guess
     *
     * @throws \Exception
     */
    public static function from(int $num): int
    {
        $step = 10_000_000_00;

        if ($num < self::LIMIT) {
            $num += $step;
        }

        if ($num > self::LIMIT) {
            $num = $num - (51 * $step) + 1; // check tests how it comes back to previous step
        }

        if ($num === self::LIMIT) {
            throw new \InvalidArgumentException('Upper limit reached for unique 6 length alphanumeric.');
        }

        return $num;
    }
}
