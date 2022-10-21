<?php

namespace BlackJack;

require_once('BlackJackHand.php');

abstract class Player
{
    /** 手札 */
    private BlackJackHand $hand;

    /**
     * デッキからカードを1枚引く
     * (抽象メソッド)
     *
     * @param BlackJackDeck $deck デッキ
     * @return string 引いたカードを表示
     */
    abstract public function drawCard(BlackJackDeck $deck): string;

    /**
     * コンストラクタ
     *
     * @param string $name 名前
     */
    public function __construct(string $name)
    {
        $this->hand = new BlackJackHand();
        $this->name = $name;
    }

    /**
     * 名前を取得する
     *
     * @return string 名前
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * トランプカード１枚を渡す
     *
     * @param BlackJackCard $card トランプカード
     * @return void
     */
    public function addHand(BlackJackCard $card): void
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
     * 手札の得点を取得する
     *
     * @return int 手札の得点
     */
    public function getHandScore(): int
    {
        return $this->hand->getHandScore();
    }

    /**
     * 手札の枚数を取得する
     *
     * @return int 手札の枚数
     */
    public function getCountHandNumber(): int
    {
        return $this->hand->getCountHandNumber();
    }
}
