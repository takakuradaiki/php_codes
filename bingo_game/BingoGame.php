<?php

namespace BingoBallGame;

require_once('BingoBall.php');
require_once('BingoCard.php');


class BingoGame
{

    private array $balls;
    private BingoCard $card;

    public function __construct()
    {
        for ($number = 1; $number <= 75; $number++) {
            $this->balls[] = new BingoBall($number);
        }
        shuffle($this->balls);
        $this->card = new BingoCard();
    }

    public function start()
    {
        echo 'ビンゴゲームを開始します。';
        echo "\n";
        while (count($this->balls) > 0) {
            $drawball = array_splice($this->balls, 0, 1)[0];
            $this->card->checkCard($drawball->getNumber());
            echo 'ball[' . $drawball->getNumber() . "]";
            for ($a = 0; $a < 5; $a++) {
                echo "\n";
                foreach ($this->card->getCardAllMass()[$a] as $value) {
                    if ($value->getNumber() === 76) {
                        echo "FREE";
                    } elseif ($value->getDisplayNumber() < 10) {
                        echo "  " . $value->getDisplayNumber() . " ";
                    } else {
                        echo " " . $value->getDisplayNumber() . " ";
                    }
                }
            }
            echo "\n";
        }
    }
}
