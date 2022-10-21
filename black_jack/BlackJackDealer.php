<?php

namespace BlackJack;

require_once('Player.php');

class BlackJackDealer extends Player
{
    /**
     * コンストラクタ
     * 名前を渡す
     *
     * @param $name 名前
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    /**
     * 引いたカードを表示する
     *
     * @param  BlackJackDeck $deck デッキ
     * @return  string 引いたカードを表示する
     */
    public function drawCard(BlackJackDeck $deck): string
    {
        $card = $deck->drawCard();
        $this->addHand($card);
        //ディーラーの引いたカードを表示する
        if ($this->getCountHandNumber() === 2) {
            return $this->name . 'の引いた2枚目のカードはわかりません。' . PHP_EOL;
        }
        return $this->name . 'の引いたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です' . PHP_EOL;
    }
}
