<?php

namespace BlackJack;

require_once('Player.php');

class BlackJackPlayer extends Player
{
    /**
     * コンストラクタ
     *
     * @param string $name 名前
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    /**
     * プレイヤーが引いたカードを表示する
     *
     * @param $deck デッキ
     * @return string 引いたカードを表示
     */
    public function drawCard(BlackJackDeck $deck): string
    {
        $card = $deck->drawCard();

        $this->addHand($card);
        return $this->name . 'の引いたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です。' . PHP_EOL;
    }
}
