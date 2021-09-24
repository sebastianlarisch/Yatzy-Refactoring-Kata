<?php

declare(strict_types=1);

namespace Yatzy;

class Yatzy
{
    private int $total;

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

    public static function twoPair(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $counts = array_fill(0, 6, 0);
        $counts[$d1 - 1] += 1;
        $counts[$d2 - 1] += 1;
        $counts[$d3 - 1] += 1;
        $counts[$d4 - 1] += 1;
        $counts[$d5 - 1] += 1;
        $n = 0;
        $score = 0;

        for ($i = 0; $i != 6; $i++)
            if ($counts[6 - $i - 1] >= 2) {
                $n = $n + 1;
                $score += (6 - $i);
            }

        if ($n == 2)
            return new self($score * 2);
        else
            return new self(0);
    }

    public static function threeOfAKind(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $t = array_fill(0, 6, 0);
        $t[$d1 - 1] += 1;
        $t[$d2 - 1] += 1;
        $t[$d3 - 1] += 1;
        $t[$d4 - 1] += 1;
        $t[$d5 - 1] += 1;

        for ($i = 0; $i != 6; $i++)
            if ($t[$i] >= 3)
                return new self(($i + 1) * 3);

        return new self(0);
    }

    public static function smallStraight(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;
        if ($tallies[0] == 1 &&
            $tallies[1] == 1 &&
            $tallies[2] == 1 &&
            $tallies[3] == 1 &&
            $tallies[4] == 1)
            return new self(15);

        return new self(0);
    }

    public static function largeStraight(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;
        if ($tallies[1] == 1 &&
            $tallies[2] == 1 &&
            $tallies[3] == 1 &&
            $tallies[4] == 1 &&
            $tallies[5] == 1)

            return new self(20);

        return new self(0);
    }

    public static function fullHouse(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $_2 = false;
        $_2_at = 0;
        $_3 = False;
        $_3_at = 0;

        $tallies = array_fill(0, 6, 0);
        $tallies[$d1 - 1] += 1;
        $tallies[$d2 - 1] += 1;
        $tallies[$d3 - 1] += 1;
        $tallies[$d4 - 1] += 1;
        $tallies[$d5 - 1] += 1;

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] == 2) {
                $_2 = True;
                $_2_at = $i + 1;
            }
        }

        foreach (range(0, 5) as $i) {
            if ($tallies[$i] == 3) {
                $_3 = True;
                $_3_at = $i + 1;
            }
        }

        if ($_2 && $_3)
            return new self($_2_at * 2 + $_3_at * 3);
        else
            return new self(0);
    }

    public static function chance(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $total = 0;
        $total += $d1;
        $total += $d2;
        $total += $d3;
        $total += $d4;
        $total += $d5;

        return new self($total);
    }

    public static function yatzy(array $dice): self
    {
        $counts = array_fill(0, count($dice) + 1, 0);
        foreach ($dice as $die) {
            $counts[$die - 1] += 1;
        }
        foreach (range(0, count($counts) - 1) as $i) {
            if ($counts[$i] == 5)
                return new self(50);
        }

        return new self(0);
    }
}
