<?php

namespace BabaNuki;

require_once('BabaNukiDeck.php');


class BabaNukiGame
{
    private BabaNukiDeck $deck;
    private BabaNukiPlayer $player;
    private array $dealers;

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
        foreach ($allPlayer as $value) {
            $value->handRemoveDuplicate($value);
        }

        $targetPlayerCnt = 0;
        $endPlayers = [];
        while (count($allPlayer) > 1) {
            if (count($allPlayer) === $targetPlayerCnt) {
                $targetPlayerCnt = 0;
            }
            if (count($allPlayer[$targetPlayerCnt]->getHand()) === 0) {
                $endPlayers[] = array_splice($allPlayer, $targetPlayerCnt, 1)[0];
                $this->winner($endPlayers);
                continue;
            }
            $allPlayer[$targetPlayerCnt]->setTargetPlayerCnt($targetPlayerCnt);
            $allPlayer[$targetPlayerCnt]->takeHand($allPlayer);

            if (count($allPlayer[$targetPlayerCnt]->getHand()) === 0) {
                $endPlayers[] = array_splice($allPlayer, $targetPlayerCnt, 1)[0];
                $this->winner($endPlayers);
                continue;
            }
            $targetPlayerCnt++;
        }
        echo $allPlayer[0]->getName() . 'が最下位です。' . PHP_EOL;
        echo 'ババ抜きを終了します。' . PHP_EOL;




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
    public function winner(array $endPlayer)
    {
        if (count($endPlayer) === 1) {
            echo $endPlayer[0]->getName() . 'が1位です。' . PHP_EOL;
        } elseif (count($endPlayer) === 2) {
            echo $endPlayer[1]->getName() . 'が2位です。' . PHP_EOL;
        } elseif (count($endPlayer) === 3) {
            echo $endPlayer[2]->getName() . 'が3位です。' . PHP_EOL;
        }
    }
}
