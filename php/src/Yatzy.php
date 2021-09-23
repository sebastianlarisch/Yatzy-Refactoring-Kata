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

    public static function yatzyScore(array $dice): self
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

    public static function ones(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $sum = 0;
        if ($d1 == 1) {
            ++$sum;
        }
        if ($d2 == 1) {
            ++$sum;
        }
        if ($d3 == 1) {
            ++$sum;
        }
        if ($d4 == 1) {
            ++$sum;
        }
        if ($d5 == 1) {
            ++$sum;
        }

        return new self($sum);
    }

    public static function twos(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $sum = 0;
        if ($d1 == 2)
            $sum += 2;
        if ($d2 == 2)
            $sum += 2;
        if ($d3 == 2)
            $sum += 2;
        if ($d4 == 2)
            $sum += 2;
        if ($d5 == 2)
            $sum += 2;

        return new self($sum);
    }

    public static function threes(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $s = 0;
        if ($d1 == 3)
            $s += 3;
        if ($d2 == 3)
            $s += 3;
        if ($d3 == 3)
            $s += 3;
        if ($d4 == 3)
            $s += 3;
        if ($d5 == 3)
            $s += 3;

        return new self($s);
    }

    public static function fours(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $s = 0;
        if ($d1 == 4)
            $s += 4;
        if ($d2 == 4)
            $s += 4;
        if ($d3 == 4)
            $s += 4;
        if ($d4 == 4)
            $s += 4;
        if ($d5 == 4)
            $s += 4;

        return new self($s);
    }

    public static function Fives(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $s = 0;
        if ($d1 == 5)
            $s += 5;
        if ($d2 == 5)
            $s += 5;
        if ($d3 == 5)
            $s += 5;
        if ($d4 == 5)
            $s += 5;
        if ($d5 == 5)
            $s += 5;

        return new self($s);
    }

    public static function sixes(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $s = 0;
        if ($d1 == 6)
            $s += 6;
        if ($d2 == 6)
            $s += 6;
        if ($d3 == 6)
            $s += 6;
        if ($d4 == 6)
            $s += 6;
        if ($d5 == 6)
            $s += 6;

        return new self($s);
    }

    public static function score_pair(int $d1, int $d2, int $d3, int $d4, int $d5): self
    {
        $counts = array_fill(0, 6, 0);
        $counts[$d1 - 1] += 1;
        $counts[$d2 - 1] += 1;
        $counts[$d3 - 1] += 1;
        $counts[$d4 - 1] += 1;
        $counts[$d5 - 1] += 1;

        for ($at = 0; $at != 6; $at++)
            if ($counts[6 - $at - 1] == 2)
                return new self((6 - $at) * 2);

        return new self(0);
    }

    public static function two_pair(int $d1, int $d2, int $d3, int $d4, int $d5): self
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

    public static function three_of_a_kind(int $d1, int $d2, int $d3, int $d4, int $d5): self
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
}
