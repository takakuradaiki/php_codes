<?php

namespace BlackJack;

/**
 * docコメントを付与する場所
 * ・プロパティ
 * ・コンストラクタ
 * ・メソッド(関数)
 *
 * ・コントロール ＋ｆで「fix」を検索して修正して
 * ・docコメントは自動生成をベースに追記して
 * ・返り値ないメソッドは「:void」※コンストラクタはのぞく （例）C:\xampp\htdocs\php_codes\black_jack\BlackJackGame.php start()メソッドみたいに
 * docコメントにも「@return void」をつけて
 * ・returnに型が無い箇所あるから修正して
 * ・returnに日本語の説明が無い箇所がある
 *
 *
 */
class BlackJackCard
{
    /** カードランク */
    private const CARD_RANK = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 10,
        'Q' => 10,
        'K' => 10,
    ];

    /** カードランク(最大) */
    public const MAX_A_RANK = 11;

    /** カードランク(最小) */
    public const MIX_A_RANK = 1;

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
     * 数字を取得する
     *
     * @return string 数字
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * 得点を取得する
     *
     * @return int 得点
     */
    public function getRank(): int
    {
        return self::CARD_RANK[$this->number];
    }
}
