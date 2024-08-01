<?php
session_start();

class YatzyGame {
    public function __construct() {
        if (!isset($_SESSION['game'])) {
            $this->initializeGame();
            $this->initializeleaderboard();
        }
    }
    public function initializeleaderboard(){
        $_SESSION['leaderboard'] = [];
    }

    public function initializeGame() {
        $_SESSION['game'] = [
            'turn' => 1,
            'reRoll' => 0,
            'diceVal' => [0, 0, 0, 0, 0],
            'diceKeep' => [false, false, false, false, false],
            'scores' => [
                'Ones' => 0, 'Twos' => 0, 'Threes' => 0, 'Fours' => 0,
                'Fives' => 0, 'Sixes' => 0, 'One Pair' => 0, 'Two Pairs' => 0,
                'Three of a Kind' => 0, 'Four of a Kind' => 0, 'Small Straight' => 0,
                'Large Straight' => 0, 'Full House' => 0, 'Chance' => 0, 'Yatzy' => 0
            ],
            'potentialScores' => [
                'Ones' => 0, 'Twos' => 0, 'Threes' => 0, 'Fours' => 0,
                'Fives' => 0, 'Sixes' => 0, 'One Pair' => 0, 'Two Pairs' => 0,
                'Three of a Kind' => 0, 'Four of a Kind' => 0, 'Small Straight' => 0,
                'Large Straight' => 0, 'Full House' => 0, 'Chance' => 0, 'Yatzy' => 0
            ],
            'totalScore' => 0,
            'bonusApplied' => false
        ];
    }

    public function getGame() {
        return $_SESSION['game'];
    }

    public function updateGame($key, $value) {
        $_SESSION['game'][$key] = $value;
    }



    public function resetGame() {

        // 重置骰子值
        $_SESSION['game']['diceVal'] = [0, 0, 0, 0, 0];

        // 重置保持骰子的状态
        $_SESSION['game']['diceKeep'] = [false, false, false, false, false];

        // 重置重新投骰子的次数
        $_SESSION['game']['reRoll'] = 0;

        // 重置潜在得分
        $_SESSION['game']['potentialScores'] = [
            'Ones' => 0, 'Twos' => 0, 'Threes' => 0, 'Fours' => 0,
            'Fives' => 0, 'Sixes' => 0, 'One Pair' => 0, 'Two Pairs' => 0,
            'Three of a Kind' => 0, 'Four of a Kind' => 0, 'Small Straight' => 0,
            'Large Straight' => 0, 'Full House' => 0, 'Chance' => 0, 'Yatzy' => 0
        ];
    }

    public function updatePotentialScores() {
        $_SESSION['game']['potentialScores'] = YatzyEngine::calculateScore($_SESSION['game']['diceVal']);
    }

    public function updateLeaderboard($newScore) {
        // 添加新分数并排序
        $_SESSION['leaderboard'][] = $newScore;
        rsort($_SESSION['leaderboard']);  // 降序排序

        // 仅保留前10名
        $_SESSION['leaderboard'] = array_slice($_SESSION['leaderboard'], 0, 10);
    }

    public function getLeaderboard() {
        return $_SESSION['leaderboard'];
    }

    public function allDiceRoll() {
        $dice = new Dice();
        for ($i = 0; $i < 5; $i++) {
            if (!$_SESSION['game']['diceKeep'][$i]) {
                $_SESSION['game']['diceVal'][$i] = $dice->roll();
            }
        }
        error_log("Dice values inside allDiceRoll: " . json_encode($_SESSION['game']['diceVal']));
    }


    public function updatePotentialScore($category, $score) {
        $_SESSION['game']['potentialScores'][$category] = $score;
    }
    private function isBonusApplied() {
        return $_SESSION['game']['bonusApplied'];
    }

    private function sumUpperScores() {
        return $_SESSION['game']['scores']['Ones'] + $_SESSION['game']['scores']['Twos'] +
            $_SESSION['game']['scores']['Threes'] + $_SESSION['game']['scores']['Fours'] +
            $_SESSION['game']['scores']['Fives'] + $_SESSION['game']['scores']['Sixes'];
    }

    public function updateScore($category, $score) {

        $_SESSION['game']['scores'][$category] += $score;
        $_SESSION['game']['totalScore'] += $score; // Assumes this is the correct logic for updating total score
        //$_SESSION['game']['turn'] +=1;

        if (!$this->isBonusApplied() && $this->sumUpperScores() > 63) {
            $_SESSION['game']['totalScore'] += 50;
            $_SESSION['game']['bonusApplied'] = true;  // 确保只添加一次
        }
    }
}


