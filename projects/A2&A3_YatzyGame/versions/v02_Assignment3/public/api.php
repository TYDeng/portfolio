<?php

require_once '../app/models/YatzyGame.php';
require_once '../app/models/YatzyEngine.php';
require_once '../app/models/Dice.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';
//$_SESSION['leaderboard'] = [];
$response = [];
$logs = [];  // 用于存储日志信息
$game = new YatzyGame();
//$game->initializeleaderboard();

switch ($action) {

    case 'initialize':

        $game->initializeGame();
        $response = $game->getGame();

        break;

    case 'roll':

        $diceKeep = isset($_POST['diceKeep']) ? array_map('filter_var', $_POST['diceKeep'], array_fill(0, count($_POST['diceKeep']), FILTER_VALIDATE_BOOLEAN)) : [false, false, false, false, false];
        $game->updateGame('diceKeep', $diceKeep);
        //$logs[] = "diceKeep read: ";

        $gameData = $game->getGame();
        $diceKeep = $gameData['diceKeep'];
        //$logs[] = "Rolling dice with diceKeep: " . json_encode($diceKeep);

        if ($gameData['reRoll'] < 3) {
            $game->allDiceRoll();
            $gameData['reRoll']++;

            $game->updateGame('reRoll', $gameData['reRoll']);

            $response = $game->getGame();
            //$logs[] = " after roll dice value" . json_encode($response['diceVal']);
            //$logs[] = " reroll numbers" . json_encode($gameData['reRoll']);
            if ($gameData['reRoll'] == 3) {
                //$logs[] = " calculate score.....";
                $game->updatePotentialScores();
                $gameData = $game->getGame();
                //$logs[] = " calculate dice value" . json_encode($gameData['diceVal']);
                //$logs[] = " after roll potential scores" . json_encode($gameData['potentialScores']);
                $response = $game->getGame();
            }
        } else {
            $response = ['error' => 'No re-roll chances'];
        }

        break;

    case 'calculateScore':

        $game->updatePotentialScores();
        $gameData = $game->getGame();
        $logs[] = " calculate dice value" . json_encode($gameData['diceVal']);
        $logs[] = " after roll potential scores" . json_encode($gameData['potentialScores']);
        $response = $game->getGame(); // 获取游戏数据，包括新的得分

        break;


    case 'updateScore':
        $category = $_POST['category'];
        $turn = isset($_POST['turn']) ? (int)$_POST['turn'] : 1;
        $gameData = $game->getGame();  // 确保获取当前游戏状态
        // Log before update

        if ($turn < 17) {
            error_log("Updating score for category: $category");
            //$logs[] = "Updating score for category: $category";

            // Calculate the score for the given category
            $score = $gameData['potentialScores'][$category];

            // Update the score in the game
            $game->updateScore($category, $score);
            $logs[] = "update turn~!!!" . json_encode($turn);
            $game->resetGame();
            $response = $game->getGame();
        }




        // Log after update
        //error_log("Score updated: " . json_encode($response));
        //$logs[] = "Score updated: " . json_encode($response);
        break;

    case 'endGame':
        $gameData = $game->getGame();
        $finalScore = $gameData['totalScore'];
        // 添加新分数并排序
        $logs[]="final score:" . json_encode($finalScore);
        $game->updateLeaderboard($finalScore);
        //$_SESSION['leaderboard'][] = $finalScore;
        //rsort($_SESSION['leaderboard']);  // 降序排序
        //$logs[]="leaderboard:" . json_encode($_SESSION['leaderboard']);
        // 仅保留前10名
        //$_SESSION['leaderboard'] = array_slice($_SESSION['leaderboard'], 0, 10);

        //$logs[]="transport leaderboard:" . json_encode($_SESSION['leaderboard']);
        $response = [
            'message' => 'Game ended',
            'leaderboard' => $_SESSION['leaderboard']
        ];
        break;



    case 'getGame':
        error_log("Getting game data...");
        $logs[] = "Getting game data...";
        $game = new YatzyGame();
        $response = $game->getGame();
        error_log("Game data retrieved: " . json_encode($response));
        $logs[] = "Game data retrieved: " . json_encode($response);
        break;

    default:
        $response = ['error' => 'Invalid action'];
        error_log("Invalid action: $action");
        $logs[] = "Invalid action: $action";
        break;
}

$response['logs'] = $logs;  // 将日志信息添加到响应中

echo json_encode($response);


