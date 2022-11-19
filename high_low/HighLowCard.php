<?php

namespace HighLow;

class HighLowCard
{
    /**
     * コンストラクタ
     *
     * @param string $suit マーク
     * @param string $number 数字
     */
    public function __construct(string $suit, string $number)
    {
        $this->suit = $suit;
        $this->number = $number;
    }

    /**
     * マークを取得する
     *
     * @return string マーク
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * 数時を取得する
     *
     * @return string 数字
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}
