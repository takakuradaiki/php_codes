<?php

namespace HighLow;

require_once('HighLowDeck.php');

class HighLowGame
{
    /** カードランク */
    private const CARD_RANK = [
        'A' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'ジョーカー' => 14,
    ];
    /** ディーラー */
    private HighLowDealer $dealer;
    /** デッキ */
    private HighLowDeck $deck;

    /**
     * コンストラクタ
     *
     * @param Player $dealer ディーラー
     * @param Player $player 私
     */
    public function __construct(Player $dealer, Player $player)
    {
        $this->player = $player;
        $this->dealer = $dealer;
        $this->deck = new HighLowDeck();
    }

    /**
     * ハイアンドローゲーム処理
     *
     * @return void
     */
    public function start()
    {
        echo 'ハイ アンド ロー を開始します。' . PHP_EOL;
        echo '' . PHP_EOL;
        $initDrawCard = $this->dealer->drawCard($this->deck);
        echo $initDrawCard;
        // アプローチ1
        while (true) {
            // while文を抜ける条件は以下2つ
            //・予想が外れた時
            //・トランプ53枚が0枚になったとき
            $answer = $this->checkHighLow();
            $initDrawCard = $this->dealer->drawCard($this->deck);
            echo $initDrawCard . PHP_EOL;
            $handNumber = $this->dealer->getCountNumber();
            $drawCards = $this->dealer->getHand();
            $drawCard1 = $drawCards[$handNumber - 2]->getNumber();
            $drawCard2 = $drawCards[$handNumber - 1]->getNumber();
            $a = self::CARD_RANK[$drawCard1];
            $b = self::CARD_RANK[$drawCard2];
            if (empty($this->deck)) {
                echo '山札がなくなりました。' . PHP_EOL;
                break;
            } else {
                if ($answer === 'H') {
                    if ($b - $a >= 0) {
                        echo '予想的中です。' . PHP_EOL;
                        continue;
                    } elseif ($b - $a <= 0) {
                        echo $this->player->name . 'は負けました。' . PHP_EOL;
                        break;
                    }
                } elseif ($answer === 'L') {
                    if ($b - $a >= 0) {
                        echo $this->player->name . 'は負けました。' . PHP_EOL;
                        break;
                    } elseif ($b - $a <= 0) {
                        echo '予想的中です。' . PHP_EOL;
                        continue;
                    }
                }
            }
        }
        echo 'ハイ アンド ローを終了します。';
    }

    /**
     * ハイアンドロー入力チェック
     *
     * @return $answer ハイ または ロー
     * @return void
     */
    private function checkHighLow()
    {
        while (true) {
            echo '次のカードがハイかローか選択してください(H/L)' . PHP_EOL;
            $answer = trim(fgets(STDIN));
            if ($answer === 'H' or $answer === 'L') {
                return $answer;
            } else {
                echo '正しく入力してください。' . PHP_EOL;
                continue;
            }
        }
    }
    // アプローチ2 for文の場合、デッキでループを回す
}
