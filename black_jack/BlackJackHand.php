<?php

namespace BlackJack;

class BlackJackHand
{
    /** 中間のスコア */
    private const BLACKJACK_HALF = 11;
    /** 手札 */
    private array $hand = [];

    /**
     * カードを手札に入れ込む
     *
     * @param $card カード
     * @return void
     */
    public function addHand(BlackJackCard $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * 手札を取得する
     *
     * @return array 手札
     */
    public function getHand(): array
    {
        return $this->hand;
    }

    /**
     * 手札の枚数を取得する
     *
     * @return integer
     */
    public function getCountHandNumber(): int
    {
        return count($this->hand);
    }

    /**
     * 手札の得点を取得する
     * 手札にAがある場合、最大ランクか最小ランクとして$handScoreに入れ込む
     * それ以外はそのままランクを入れ込む
     *
     * @return int 手札の得点
     */
    public function getHandScore(): int
    {
        $handScore = 0;
        $countA = 0;
        foreach ($this->hand as $card) {
            if ($card->getNumber() === 'A') {
                $countA++;
            } else {
                $handScore += $card->getRank();
            }
        }

        for ($i = 0; $i < $countA; $i++) {
            if ($handScore < self::BLACKJACK_HALF) {
                $handScore += BlackJackCard::MAX_A_RANK;
            } else {
                $handScore += BlackJackCard::MIX_A_RANK;
            }
        }
        return $handScore;
    }
}
