<?php

namespace BabaNuki;

require_once('Player.php');

class BabaNukiDealer extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
    public function drawCard(BabaNukiDeck $deck)
    {
        $card = $deck->drawCard();
        $this->addHand($card);
    }


    /**
     * 相手からカードを引く処理
     * (具象メソッド)
     *
     * @param
     * @return
     */
    // public function 相手からカードを引く処理
    public function takeHand(array $allPlayer)
    {
        $targetPlayerCnt = $this->getTargetPlayerCnt();
        echo $this->getName() . 'の手札は' . count($this->getHand()) . '枚です。' . PHP_EOL;
        $count = 1;
        if (count($allPlayer) - 1 === $targetPlayerCnt) {
            $count = -count($allPlayer) + 1;
        }
        $answer = 0;
        $tookCard = $allPlayer[$targetPlayerCnt + $count]->takeCard($answer);
        $this->putCard($tookCard);
        $this->handRemoveDuplicate($allPlayer[$targetPlayerCnt]);
        echo $this->getName() . 'の手札は' . count($this->getHand()) . '枚になりました。' . PHP_EOL;
    }
}
