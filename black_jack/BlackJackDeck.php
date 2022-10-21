<?php

namespace BlackJack;

require_once('BlackJackCard.php');

class BlackJackDeck
{
    /** マーク */
    private const SUIT = ['ハート', 'ダイヤ', 'クローバー', 'スペード'];

    /** 数字 */
    private const NUMBER = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    /**デッキ */
    private array $deck;

    /**
     * コンストラクタ
     * トランプ５２枚作成
     */
    public function __construct()
    {
        foreach (self::SUIT as $suit) {
            foreach (self::NUMBER as $number) {
                $this->deck[] = new BlackJackCard($suit, $number);
            }
        }
        $this->shuffleDeck();
    }

    /**
     * デッキからカードを１枚引く
     *
     * @return BlackJackCard 引いたカード
     */
    public function drawCard(): BlackJackCard
    {
        $drawCard = array_splice($this->deck, 0, 1)[0];
        return $drawCard;
    }

    /**
     * デッキをシャッフルする
     *
     * @return void
     */
    private function shuffleDeck(): void
    {
        shuffle($this->deck);
    }
}
