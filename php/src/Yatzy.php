<?php

declare(strict_types=1);

namespace Yatzy;

class Yatzy
{
    private int $total;

    private const SCORE_ZERO = 0;
    private const SCORE_SMALL_STREET = 15;
    private const SCORE_LARGE_STREET = 20;
    private const SCORE_YATZY = 50;

    private function __construct(int $total)
    {
        $this->total = $total;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public static function ones(array $dice): self
    {
        $ones = array_filter($dice, fn($v) => $v === 1);

        return new self(array_sum($ones));
    }

    public static function twos(array $dice): self
    {
        $twos = array_filter($dice, fn($v) => $v === 2);

        return new self(array_sum($twos));
    }

    public static function threes(array $dice): self
    {
        $threes = array_filter($dice, fn($v) => $v === 3);

        return new self(array_sum($threes));
    }

    public static function fours(array $dice): self
    {
        $fours = array_filter($dice, fn($v) => $v === 4);

        return new self(array_sum($fours));
    }

    public static function fives(array $dice): self
    {
        $fives = array_filter($dice, fn($v) => $v === 5);

        return new self(array_sum($fives));
    }

    public static function sixes(array $dice): self
    {
        $sixes = array_filter($dice, fn($v) => $v === 6);

        return new self(array_sum($sixes));
    }

    public static function onePair(array $dice): self
    {
        rsort($dice);

        $values = array_count_values($dice);

        $pairs = array_filter($values, fn($value) => $value === 2);

        return new self(array_key_first($pairs) * array_pop($pairs));
    }

    public static function twoPair(array $dice): self
    {
        $values = array_count_values($dice);

        $pairs = array_filter($values, fn($value) => $value === 2);

        $total = 0;

        foreach ($pairs as $key => $value) {
            $total += $key * $value;
        }

        return new self($total);
    }

    public static function threeOfAKind(array $dice): self
    {
        $values = array_count_values($dice);

        $triple = array_filter($values, fn($value) => $value === 3);

        return new self(array_key_first($triple) * array_pop($triple));
    }

    public static function smallStraight(array $dice): self
    {
        if (empty(array_diff([1, 2, 3, 4, 5], $dice))) {
            return new self(self::SCORE_SMALL_STREET);
        }

        return new self(self::SCORE_ZERO);
    }

    public static function largeStraight(array $dice): self
    {
        if (empty(array_diff([2, 3, 4, 5, 6], $dice))) {
            return new self(self::SCORE_LARGE_STREET);
        }

        return new self(self::SCORE_ZERO);
    }

    public static function fullHouse(array $dice): self
    {
        $total = 0;

        $values = array_count_values($dice);

        $double = array_filter($values, fn($value) => $value === 2);
        $triple = array_filter($values, fn($value) => $value === 3);

        if (empty($double) || empty($triple)) {
            return new self(self::SCORE_ZERO);
        }

        $total += array_key_first($double) * array_pop($double);
        $total += array_key_first($triple) * array_pop($triple);

        return new self($total);
    }

    public static function chance(array $dice): self
    {
        return new self(array_sum($dice));
    }

    public static function yatzy(array $dice): self
    {
        if (count(array_unique($dice)) === 1) {
            return new self(self::SCORE_YATZY);
        }

        return new self(self::SCORE_ZERO);
    }
}
