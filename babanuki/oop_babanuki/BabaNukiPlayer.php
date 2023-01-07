<?php

namespace BabaNuki;

class BabaNukiPlayer extends Player
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
        $targetPlayerCnt = 0;
        echo $this->getName() . 'の手札は' . count($this->getHand()) . '枚です。' . PHP_EOL;
        $playerName = $allPlayer[$targetPlayerCnt + 1]->getName();
        echo $playerName . 'の手札の枚数は' . count($allPlayer[$targetPlayerCnt + 1]->getHand()) . '枚です。何枚目のカードを引きますか？' . PHP_EOL;
        $answer = trim(fgets(STDIN));
        // $answer = 0;
        $tookCard = $allPlayer[$targetPlayerCnt + 1]->takeCard($answer);
        $this->putCard($tookCard);
        $this->handRemoveDuplicate($allPlayer[$targetPlayerCnt]);
        echo $this->getName() . 'の手札は' . count($this->getHand()) . '枚になりました。' . PHP_EOL;
    }
}
