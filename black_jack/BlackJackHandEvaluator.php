<?php

namespace BlackJack;

class BlackJackHandEvaluator
{
    /** ブラックジャックの値 */
    private const BLACK_JACK = 21;
    /** バーストする値 */
    private const HAND_BURST = 22;
    /** 引き分け */
    private const DRAW = 'Draw';

    /**
     * 勝者を判定する
     * 得点と手札の枚数と名前を代入する
     *
     * @param $dealer ディーラー
     * @param $player プレイヤー
     * @return string 名前または引き分け
     */
    public function getWinner(Player $dealer, Player $player): string
    {
        $dealerHandScore = $dealer->getHandScore();
        $playerHandScore = $player->getHandScore();
        $dealerHandNumber = $dealer->getCountHandNumber();
        $playerHandNumber = $player->getCountHandNumber();
        $dealerName = $dealer->getName();
        $playerName = $player->getName();

        if ($this->isBust($dealerHandScore) && $this->isBust($playerHandScore)) {
            return $dealerName;
        } elseif ($this->isBust($playerHandScore)) {
            return $dealerName;
        } elseif ($this->isBust($dealerHandScore)) {
            return $playerName;
        } elseif ($playerHandScore > $dealerHandScore) {
            return $playerName;
        } elseif ($dealerHandScore > $playerHandScore) {
            return $dealerName;
        } else {
            if ($this->isBlackJack($dealerHandScore, $dealerHandNumber) && $this->isBlackJack($playerHandScore, $playerHandNumber)) {
                return self::DRAW;
            } elseif ($this->isBlackJack($dealerHandScore, $dealerHandNumber)) {
                return $dealerName;
            } else {
                return self::DRAW;
            }
        }
    }

    /**
     *手札がバーストしているかを判定
     *
     * @param $handScore 手札のスコア
     * @return bool 手札のスコア>=22
     */
    public function isBust(int $handScore): bool
    {
        return $handScore >= self::HAND_BURST;
    }

    /**
     * 手札がブラックジャックか判定する
     *
     *
     * @param $handScore 得点
     * @param $handNumber 手札の枚数
     * @return bool 手札の得点 === 21 && 手札の枚数 === 2
     */
    private function isBlackJack(int $handScore, int $handNumber): bool
    {
        return $handScore === self::BLACK_JACK && $handNumber === 2;
    }
}
