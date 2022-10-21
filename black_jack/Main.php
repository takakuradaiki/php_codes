<?php

namespace BlackJack;

require_once('BlackJackDealer.php');
require_once('BlackJackPlayer.php');
require_once('BlackJackGame.php');

/** ゲーム参加人数 */
$all_human_count;

while (true) {
    $answer = trim(fgets(STDIN));
    if ($answer === '2') {
        $all_human_count = '2';
        break;
    } elseif ($answer === '3') {
        $all_human_count = '3';
        break;
    } elseif ($answer === '4') {
        $all_human_count = '4';
        break;
    }
}

if ($all_human_count === '2') {
    $dealer1 = new BlackJackDealer('ディーラー１');
    $dealers[] = $dealer1;
    $player = new BlackJackPlayer('私');
    $game = new BlackJackGame($dealers, $player);
    $game->start();
} elseif ($all_human_count === '3') {
    $dealer1 = new BlackJackDealer('ディーラー１');
    $dealer2 = new BlackJackDealer('ディーラー２');
    $dealers = [$dealer1, $dealer2];
    $player = new BlackJackPlayer('私');
    $game = new BlackJackGame($dealers, $player);
    $game->start();
} elseif ($all_human_count === '4') {
    $dealer1 = new BlackJackDealer('ディーラー１');
    $dealer2 = new BlackJackDealer('ディーラー２');
    $dealer3 = new BlackJackDealer('ディーラー３');
    $dealers = [$dealer1, $dealer2, $dealer3];
    $player = new BlackJackPlayer('私');
    $game = new BlackJackGame($dealers, $player);
    $game->start();
}
