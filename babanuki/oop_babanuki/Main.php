<?php

namespace BabaNuki;

require_once('BabaNukiDealer.php');
require_once('BabaNukiPlayer.php');
require_once('BabaNukiGame.php');

$all_human_count = '3';

// while (true) {
//     $answer = trim(fgets(STDIN));
//     if ($answer === '2') {
//         $all_human_count = '2';
//         break;
//     } elseif ($answer === '3') {
//         $all_human_count = '3';
//         break;
//     } elseif ($answer === '4') {
//         $all_human_count = '4';
//     } else {
//         echo '正しく入力してください。' . PHP_EOL;
//     }
// }
if ($all_human_count === '2') {
    $dealer1 = new BabaNukiDealer('ディーラー1');
    $dealers[] = $dealer1;
    $player = new BabaNukiPlayer('私');
    $game = new BabaNukiGame($dealers, $player);
    $game->start();
} elseif ($all_human_count === '3') {
    $dealer1 = new BabaNukiDealer('ディーラー1');
    $dealer2 = new BabaNukiDealer('ディーラー2');
    $dealers = [$dealer1, $dealer2];
    $player = new BabaNukiPlayer('私');
    $game = new BabaNukiGame($dealers, $player);
    $game->start();
} elseif ($all_human_count === '4') {
    $dealer1 = new BabaNukiDealer('ディーラー1');
    $dealer2 = new BabaNukiDealer('ディーラー2');
    $dealer3 = new BabaNukiDealer('ディーラー3');
    $dealers = [$dealer1, $dealer2, $dealer3];
    $player = new BabaNukiPlayer('私');
    $game = new BabaNukiGame($dealers, $player);
    $game->start();
}
