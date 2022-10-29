<?php

/**
 * ◯お題
 * スーパーで買い物したときの支払金額を計算するプログラムを書きましょう。
 * 以下の商品リストがあります。先頭の数字は商品番号です。金額は税抜です。
 *
 * 1. 玉ねぎ 100円
 * 2. 人参 150円
 * 3. りんご 200円
 * 4. ぶどう 350円
 * 5. 牛乳 180円
 * 6. 卵 220円
 * 7. 唐揚げ弁当 440円
 * 8. のり弁 380円
 * 9. お茶 80円
 * 10. コーヒー 100円
 *
 * また、以下の条件を満たすと割引されます。
 *
 * a. 玉ねぎは3つ買うと50円引き
 * b. 玉ねぎは5つ買うと100円引き
 * c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
 * d. お弁当は20〜23時はタイムセールで半額
 *
 * 合計金額（税込み）を求めてください。
 *
 * ◯仕様
 * 金額を計算するcalc関数を定義してください。
 * calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数に取り、合計金額（税込み）を返します。
 * 購入時刻：HH:MM形式（例. 20:00）とし、商品番号は1〜10の整数とします。
 * 同時に買える商品は20個までです。また、購入時刻は9〜23時です。
 *
 * ◯実行例
 * calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10])  //=> 1298
 *
 */

/** 玉ねぎのカウント数 */
const FIRST_ONION_DISCOUNT_NUMBER = 3;
/** 玉ねぎの値引き値 */
const FIRST_ONION_DISCOUNT_PRICE = 50;
/** 玉ねぎのカウント数 */
const SECOND_ONION_DISCOUNT_NUMBER = 5;
/** 玉ねぎの値引き値 */
const SECOND_ONION_DISCOUNT_PRICE = 100;
/** 弁当と飲み物をセット購入した時の値引き値 */
const SET_DISCOUNT_PRICE = 20;
/** 弁当が値引きされ始める時間 */
const BENTO_DISCOUNT_START_TIME = '20:00';
/** 消費税 */
const TAX = 10;
/** 商品の値段と種類 */
const PRICES = [
    1 => ['price' => 100, 'type' => ''],
    2 => ['price' => 150, 'type' => ''],
    3 => ['price' => 200, 'type' => ''],
    4 => ['price' => 350, 'type' => ''],
    5 => ['price' => 180, 'type' => 'drink'],
    6 => ['price' => 220, 'type' => ''],
    7 => ['price' => 440, 'type' => 'bento'],
    8 => ['price' => 380, 'type' => 'bento'],
    9 => ['price' => 80, 'type' => 'drink'],
    10 => ['price' => 100, 'type' => 'drink'],
];

// $aaa = calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]);
$aaa = calc('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10, 1, 1, 4, 7, 8, 6, 4, 6]);
print_r($aaa) . PHP_EOL;

/**
 * 支払金額を計算する
 *
 * @param string $time 時間
 * @param array $items 商品
 * @return integer 支払料金
 */
function calc(string $time, array $items): int
{
    $totalAmount = 0;
    $bentoAmount = 0;
    $drink = 0;
    $bento = 0;
    foreach ($items as $item) {
        $totalAmount += PRICES[$item]['price'];
        // 商品の中にある飲み物と弁当をそれぞれ合計する
        if (PRICES[$item]['type'] === 'drink') {
            $drink++;
        }
        if (PRICES[$item]['type'] === 'bento') {
            $bento++;
            $bentoAmount += PRICES[$item]['price'];
        }
    }

    $totalAmount -= discountOnion(array_count_values($items)[1]);
    $totalAmount -= discountSet($drink, $bento);
    $totalAmount -= discountBento($time, $bentoAmount);

    return (int) $totalAmount * (100 + TAX) / 100;
}

/**
 * 玉ねぎの買った数によって値引きする
 *
 * @param integer $number 玉ねぎの数
 * @return integer 値引き値
 */
function discountOnion(int $number): int
{
    $discount = 0;
    if ($number >= SECOND_ONION_DISCOUNT_NUMBER) {
        $discount = SECOND_ONION_DISCOUNT_PRICE;
    } elseif ($number >= FIRST_ONION_DISCOUNT_NUMBER) {
        $discount = FIRST_ONION_DISCOUNT_PRICE;
    }
    return $discount;
}

/**
 * 飲み物と弁当のセット数分値引きする
 *
 * @param integer $drinkNumber 飲み物の数
 * @param integer $bentoNumber 弁当の数
 * @return integer 値引き値
 */
function discountSet(int $drinkNumber, int $bentoNumber): int
{
    return SET_DISCOUNT_PRICE * min([$drinkNumber, $bentoNumber]);
}

/**
 * 買い物をした時間が20:00以降なら弁当を半額にする
 *
 * @param string $time 買い物した時間
 * @param integer $bentoAmount 弁当の数
 * @return integer 値引き値
 */
function discountBento(string $time, int $bentoAmount): int
{
    if (strtotime(BENTO_DISCOUNT_START_TIME) > strtotime($time)) {
        return 0;
    }

    return (int) $bentoAmount / 2;
}
