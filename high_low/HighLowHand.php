<?php

namespace HighLow;

class HighLowHand
{
    /** 手札 */
    private array $hand = [];

    /**
     * 手札にカードを入れ込む
     *
     * @param HighLowCard $card カード
     * @return void
     */
    public function addHand(HighLowCard $card): void
    {
        $this->hand[] = $card;
    }

    /**
     * 手札を取得する
     *
     * @return array
     */
    public function getHand(): array
    {
        return $this->hand;
    }

    /**
     * 手札の枚数をカウントする
     *
     * @return integer 手札の枚数
     */
    public function getCountHandNumber(): int
    {
        return count($this->hand);
    }
}
