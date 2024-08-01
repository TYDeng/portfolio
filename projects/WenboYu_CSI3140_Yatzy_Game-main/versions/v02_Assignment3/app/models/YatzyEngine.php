<?php

require_once 'YatzyGame.php';  // 确保引入 YatzyGame 类

class YatzyEngine {
    // 计算特定数字的总和
    private static function sumSpecificNumber($diceVal, $number) {
        return array_sum(array_filter($diceVal, function($val) use ($number) {
            return $val == $number;
        }));
    }

    // 计算最高的一对
    private static function calculateOnePair($diceVal) {
        $counts = array_count_values($diceVal);
        for ($i = 6; $i > 0; $i--) {
            if (isset($counts[$i]) && $counts[$i] >= 2) {
                return $i * 2;
            }
        }
        return 0;
    }

    // 计算两对
    private static function calculateTwoPairs($diceVal) {
        $counts = array_count_values($diceVal);
        $pairs = 0;
        $score = 0;
        foreach ($counts as $value => $count) {
            if ($count >= 2) {
                $pairs++;
                $score += $value * 2;
                if ($pairs == 2) {
                    return $score;
                }
            }
        }
        return 0;  // 没有两对时返回0
    }

    // 计算三条
    private static function calculateThreeOfAKind($diceVal) {
        $counts = array_count_values($diceVal);
        foreach ($counts as $value => $count) {
            if ($count >= 3) {
                return $value * 3;
            }
        }
        return 0;
    }

    // 计算四条
    private static function calculateFourOfAKind($diceVal) {
        $counts = array_count_values($diceVal);
        foreach ($counts as $value => $count) {
            if ($count >= 4) {
                return $value * 4;
            }
        }
        return 0;
    }

    // 计算小顺
    private static function calculateSmallStraight($diceVal) {
        $required = [1, 2, 3, 4, 5];
        sort($diceVal);
        return ($diceVal === $required) ? 15 : 0;
    }

    // 计算大顺
    private static function calculateLargeStraight($diceVal) {
        $required = [2, 3, 4, 5, 6];
        sort($diceVal);
        return ($diceVal === $required) ? 20 : 0;
    }

    // 计算满屋
    private static function calculateFullHouse($diceVal) {
        $counts = array_count_values($diceVal);
        $hasThree = false;
        $hasTwo = false;
        $score = 0;
        foreach ($counts as $value => $count) {
            if ($count == 3) {
                $hasThree = true;
                $score += $value * 3;
            } elseif ($count == 2) {
                $hasTwo = true;
                $score += $value * 2;
            }
        }
        return ($hasThree && $hasTwo) ? $score : 0;
    }

    // 计算机会
    private static function calculateChance($diceVal) {
        return array_sum($diceVal);
    }

    // 计算 Yatzy
    private static function calculateYatzy($diceVal) {
        $counts = array_count_values($diceVal);
        return (in_array(5, $counts)) ? 50 : 0;
    }

    // 计算总分逻辑，返回所有得分类型的结果
    public static function calculateScore($diceVal) {
        return [
            'Ones' => self::sumSpecificNumber($diceVal, 1),
            'Twos' => self::sumSpecificNumber($diceVal, 2),
            'Threes' => self::sumSpecificNumber($diceVal, 3),
            'Fours' => self::sumSpecificNumber($diceVal, 4),
            'Fives' => self::sumSpecificNumber($diceVal, 5),
            'Sixes' => self::sumSpecificNumber($diceVal, 6),
            'One Pair' => self::calculateOnePair($diceVal),
            'Two Pairs' => self::calculateTwoPairs($diceVal),
            'Three of a Kind' => self::calculateThreeOfAKind($diceVal),
            'Four of a Kind' => self::calculateFourOfAKind($diceVal),
            'Small Straight' => self::calculateSmallStraight($diceVal),
            'Large Straight' => self::calculateLargeStraight($diceVal),
            'Full House' => self::calculateFullHouse($diceVal),
            'Chance' => self::calculateChance($diceVal),
            'Yatzy' => self::calculateYatzy($diceVal)
        ];
    }
}




