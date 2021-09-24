<?php
declare(strict_types=1);

namespace Yatzy\Tests;

use PHPUnit\Framework\TestCase;
use Yatzy\Yatzy;

class YatzyTest extends TestCase
{
    public function test_ones_score_0(): void
    {
        $actual = Yatzy::ones([6, 2, 2, 4, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_ones_score_1(): void
    {
        $actual = Yatzy::ones([1, 2, 3, 4, 5]);
        self::assertSame(1, $actual->getTotal());
    }

    public function test_twos_score_0(): void
    {
        $actual = Yatzy::twos([4, 5, 3, 1, 6]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_twos_score_4(): void
    {
        $actual = Yatzy::twos([1, 2, 3, 2, 6]);
        self::assertSame(4, $actual->getTotal());
    }

    public function test_twos_score_10(): void
    {
        $actual = Yatzy::twos([2, 2, 2, 2, 2]);
        self::assertSame(10, $actual->getTotal());
    }

    public function test_threes_score_0(): void
    {
        $actual = Yatzy::threes([1, 2, 5, 2, 6]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_threes_score_6(): void
    {
        $actual = Yatzy::threes([1, 2, 3, 2, 3]);
        self::assertSame(6, $actual->getTotal());
    }

    public function test_fours_score_0(): void
    {
        $actual = Yatzy::fours([1, 2, 6, 5, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_fours_score_8(): void
    {
        $actual = Yatzy::fours([1, 4, 6, 4, 5]);
        self::assertSame(8, $actual->getTotal());
    }

    public function test_fives_score_0(): void
    {
        $actual = Yatzy::fives([4, 4, 4, 2, 6]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_fives_score_10(): void
    {
        $actual = Yatzy::fives([4, 4, 4, 5, 5]);
        self::assertSame(10, $actual->getTotal());
    }

    public function test_sixes_score_0(): void
    {
        $actual = Yatzy::sixes([4, 4, 4, 5, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_sixes_score_12(): void
    {
        $actual = Yatzy::sixes([4, 4, 4, 6, 6]);
        self::assertSame(12, $actual->getTotal());
    }

    public function test_one_pair_score_0(): void
    {
        $actual = Yatzy::onePair([3, 4, 1, 5, 6]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_one_pair_score_6(): void
    {
        $actual = Yatzy::onePair([3, 4, 3, 5, 6]);
        self::assertSame(6, $actual->getTotal());
    }

    public function test_one_pair_score_10(): void
    {
        $actual = Yatzy::onePair([5, 3, 3, 5, 6]);
        self::assertSame(10, $actual->getTotal());
    }

    public function test_one_pair_score_12(): void
    {
        $actual = Yatzy::onePair([3, 4, 6, 5, 6]);
        self::assertSame(12, $actual->getTotal());
    }

    public function test_two_pair_score_0(): void
    {
        $actual = Yatzy::twoPair([3, 6, 1, 4, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_two_pair_score_16(): void
    {
        $actual = Yatzy::twoPair([3, 3, 5, 4, 5]);
        self::assertSame(16, $actual->getTotal());
    }

    public function test_three_of_a_kind_score_0(): void
    {
        $actual = Yatzy::threeOfAKind([3, 3, 2, 4, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_three_of_a_kind_score_9(): void
    {
        $actual = Yatzy::threeOfAKind([3, 3, 3, 4, 5]);
        self::assertSame(9, $actual->getTotal());
    }

    public function test_small_straight_score_0(): void
    {
        $actual = Yatzy::smallStraight([1, 2, 6, 4, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_small_straight_score_15(): void
    {
        $actual = Yatzy::smallStraight([1, 2, 3, 4, 5]);
        self::assertSame(15, $actual->getTotal());
    }

    public function test_large_straight_score_0(): void
    {
        $actual = Yatzy::largeStraight([6, 2, 1, 4, 5]);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_large_straight_score_20(): void
    {
        $actual = Yatzy::largeStraight([6, 2, 3, 4, 5]);
        self::assertSame(20, $actual->getTotal());
    }

    public function test_full_house_score_0(): void
    {
        $actual = Yatzy::fullHouse(6, 2, 1, 2, 6);
        self::assertSame(0, $actual->getTotal());
    }

    public function test_full_house_score_18(): void
    {
        $actual = Yatzy::fullHouse(6, 2, 2, 2, 6);
        self::assertSame(18, $actual->getTotal());
    }

    public function test_chance_scores_sum_of_all_dice(): void
    {
        $actual = Yatzy::chance(2, 3, 4, 5, 1);
        self::assertSame(15, $actual->getTotal());
    }

    public function test_yatzy_scores_50(): void
    {
        $actual = Yatzy::yatzy([4, 4, 4, 4, 4]);
        self::assertSame(50, $actual->getTotal());
    }

    public function test_yatzy_scores_0(): void
    {
        $actual = Yatzy::yatzy([4, 4, 4, 4, 3]);
        self::assertSame(0, $actual->getTotal());
    }
}
