<?php

namespace HighLow;


require_once('HighLowCard.php');

class HighLowDeck
{
    /** マーク */
    private const SUIT = ['ハート', 'ダイヤ', 'クローバー', 'スペード'];

    /** 数字 */
    private const NUMBER = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    /** ジョーカー */
    private const JOKER = 'ジョーカー';

    /** デッキ */
    private array $deck;

    /**
     * コンストラクタ
     * トランプ53枚生成
     */
    public function __construct()
    {
        foreach (self::SUIT as $suit) {
            foreach (self::NUMBER as $number) {
                $this->deck[] = new HighLowCard($suit, $number);
            }
        }

        $this->deck[] = new HighLowCard('', self::JOKER);
        $this->shuffleDeck();
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

    /**
     * デッキからカードを１枚抜き取る
     *
     * @return HighLowCard カード
     */
    public function drawCard(): HighLowCard
    {
        $drawCard = array_splice($this->deck, 0, 1)[0];
        return $drawCard;
    }
}
