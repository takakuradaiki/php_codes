<?php

namespace HighLow;

require_once('HighLowDealer.php');
require_once('HighLowPlayer.php');
require_once('HighLowGame.php');

$dealer = new HighLowDealer('ディーラー');
$player = new HighLowPlayer('私');
$game = new HighLowGame($dealer, $player);
$game->start();
