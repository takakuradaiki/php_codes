<?php

namespace HighLow;

require_once('player.php');
require_once('HighLowHand.php');

class HighLowDealer extends Player
{
    /** 手札 */
    private HighLowHand $hand;
    /**
     * コンストラクタ
     *
     * @param string $name 名前
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->hand = new HighLowHand();
    }

    /**
     * トランプカードを1枚渡す
     *
     * @param HighLowCard $card
     * @return void
     */
    public function addHand(HighLowCard $card): void
    {
        $this->hand->addHand($card);
    }

    /**
     * 手札を取得する
     *
     * @return array 手札
     */
    public function getHand(): array
    {
        return $this->hand->getHand();
    }

    /**
     * 手札の枚数を取得する
     *
     * @return integer 手札の枚数
     */
    public function getCountNumber(): int
    {
        return $this->hand->getCountHandNumber();
    }

    /**
     * カード１枚引いて、表示する
     *
     * @param HighLowDeck $deck デッキ
     * @return string 引いたカードを表示する
     */
    public function drawCard(HighLowDeck $deck): string
    {
        $card = $deck->drawCard();
        $this->addHand($card);
        return $this->name . 'の見せたカードは' . $card->getSuit() . 'の' . $card->getNumber() . 'です' . PHP_EOL;
    }
}
