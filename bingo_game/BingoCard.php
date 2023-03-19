<?php

namespace BingoBallGame;

require_once('BingoMass.php');

class BingoCard
{
    private array $b = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
    private array $i = [16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30];
    private array $n = [31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45];
    private array $g = [46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60];
    private array $o = [61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75];

    private array $cardAllMass;

    private int $reachvalue;
    private int $bingovalue;
    private int $ballvalue;

    // マスクラスを作る


    public function __construct()
    {
        shuffle($this->b);
        shuffle($this->i);
        shuffle($this->n);
        shuffle($this->g);
        shuffle($this->o);
        $this->cardAllMass = [
            [0, 1, 2, 3, 4],
            [0, 1, 2, 3, 4],
            [0, 1, 2, 3, 4],
            [0, 1, 2, 3, 4],
            [0, 1, 2, 3, 4]
        ];
        for ($a = 0; $a < 5; $a++) {
            for ($j = 0; $j < 5; $j++) {
                $randomNumber = $this->randNumber($a, $j);
                $this->cardAllMass[$a][$j] = new BingoMass($randomNumber);
            }
        }
        $this->reachvalue = 0;
        $this->bingovalue = 0;
        $this->ballvalue = 0;
    }

    public function randNumber($a, $j)
    {
        if ($a === 2 && $j === 2) {
            return 76;
        } elseif ($a === 0) {
            return array_splice($this->b, 0, 1)[0];
        } elseif ($a === 1) {
            return array_splice($this->i, 0, 1)[0];
        } elseif ($a === 2) {
            return array_splice($this->n, 0, 1)[0];
        } elseif ($a === 3) {
            return array_splice($this->g, 0, 1)[0];
        } elseif ($a === 4) {
            return array_splice($this->o, 0, 1)[0];
        }
    }

    public function checkCard($ball)
    {
        for ($targetKeyCnt = 0; $targetKeyCnt < 5; $targetKeyCnt++) {
            foreach ($this->cardAllMass[$targetKeyCnt] as $value) {
                if ($ball === $value->getNumber()) {
                    $value->setFlag();
                    $value->setDisplayNumber($ball);
                } else {
                    continue;
                }
            }
        }
    }

    public function getCardAllMass()
    {
        return $this->cardAllMass;
    }
}
