<?php

namespace BabaNuki;

require_once('BabaNukiDeck.php');


class BabaNukiGame
{
    public function __construct(array $dealers, Player $player)
    {
        $this->dealers = $dealers;
        $this->player = $player;
        $this->deck = new BabaNukiDeck();
    }

    public function start(): void
    {
        echo 'ババ抜きを開始します。' . PHP_EOL;
        $allPlayer = [$this->player];
        foreach ($this->dealers as $value) {
            $allPlayer[] = $value;
        }


        // アプローチ1
        $targetPlayerCnt = 0;
        foreach ($this->deck->getDeck() as $value) {
            if (count($allPlayer) === $targetPlayerCnt) {
                $targetPlayerCnt = 0;
            }
            $allPlayer[$targetPlayerCnt]->addHand($value);

            $targetPlayerCnt++;
        }

        //重複カード削除
        $this->handRemoveDuplicate($this->player);
        // アプローチ2
        // for ($i = 0; $i < 53; $i++) {
        //     $drawplayer = current($allPlayer);
        //     if ($allPlayer[0] === $drawplayer) {
        //         $drawplayer->drawCard($this->deck);
        //         next($allPlayer);
        //     } elseif ($allPlayer[1] === $drawplayer) {
        //         $drawplayer->drawCard($this->deck);
        //         if (count($allPlayer) === 2) {
        //             reset($allPlayer);
        //         } else {
        //             next($allPlayer);
        //         }
        //     } elseif ($allPlayer[2] === $drawplayer) {
        //         $drawplayer->drawCard($this->deck);
        //         if (count($allPlayer) === 3) {
        //             reset($allPlayer);
        //         } else {
        //             next($allPlayer);
        //         }
        //     } elseif ($allPlayer[3] === $drawplayer) {
        //         $drawplayer->drawCard($this->deck);
        //         reset($allPlayer);
        //     }
        // $this->player->drawCard($this->deck);
        // }

        // 重複を捨てる処理
    }
    public function handRemoveDuplicate(Player $player)
    {
        for ($i = 0; $i < count($player->hand->getHand()); $i++) {
            $oneCard = $player->hand->getHand()[$i];
            if ($oneCard->getNumber() === '削除') {
                continue;
            }
            for ($j = $i + 1; $j < count($player->hand->getHand()); $j++) {
                $targetCard = $player->hand->getHand()[$j];
                if ($oneCard->getNumber() === $targetCard->getNumber()) {
                    $oneCard->setNumber('削除');
                    $targetCard->setNumber('削除');
                    break;
                }
            }
        }

        $val = '削除';
        foreach ($player->hand->getHand() as $key => $value) {
            if ($value->getNumber() == $val) {
                array_splice($player->hand->getHand(), $key, 1);
            }
        }
    }
}
