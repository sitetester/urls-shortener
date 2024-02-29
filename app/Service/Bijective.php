<?php
declare(strict_types=1);

namespace App\Service;

class Bijective
{
    private string $alphaNum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

    /**
     * It will generate alphanumeric string for given number
     * Length of generated string depends on length of given number
     */
    public function encode(int $num): string
    {
        if ($num == 0) {
            return $this->alphaNum[0];
        }

        $str = '';
        $totalChars = strlen($this->alphaNum);

        while ($num > 0) {
            $remainder = $num % $totalChars;

            $str .= $this->alphaNum[$remainder];
            $num = floor($num / $totalChars);
        }

        return strrev($str);
    }

    /**
     * Verify that it can convert back to original number
     */
    public function decode(string $input): int
    {
        $i = 0;
        $totalChars = strlen($this->alphaNum);
        $alphaNums = str_split($this->alphaNum);

        $chars = str_split($input);
        foreach ($chars as $char) {
            $pos = array_search($char, $alphaNums);
            $i = ($i * $totalChars) + $pos;
        }

        return $i;
    }
}
