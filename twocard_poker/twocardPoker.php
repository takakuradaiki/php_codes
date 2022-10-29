<?php

/** ハイカードの役 */
const HIGH_CARD = 'high card';
/** ペアの役 */
const PAIR = 'pair';
/** ストレートの役 */
const STRAIGHT = 'straight';
/** トランプカード */
const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

define('CARD_RANK', (function () {
    $cardRanks = [];
    foreach (CARDS as $index => $card) {
        $cardRanks[$card] = $index;
        [$card] = $index;
    }
    return $cardRanks;
})());
/** 役のランク */
const HAND_RANK = [
    HIGH_CARD => 1,
    PAIR => 2,
    STRAIGHT => 3,
];

// (例) $aa = 2 ※この「2」は、「右の勝ち」を表現している
$aa = showDown('CK', 'DJ', 'K10', 'H10');
print_r($aa);

/**
 * ポーカーメイン処理
 * （例）input:['CK', 'DJ', 'K10', 'H10'] output:['high card', 'pair', 2]
 *
 * @param string $card11 カード1枚目
 * @param string $card12 カード２枚目
 * @param string $card21 相手のカード１枚目
 * @param string $card22 相手のカード２枚目
 * @return array 役のランクと役の名前と勝者
 */
function showDown(string $card11, string $card12, string $card21, string $card22): array
{
    // (例) $cardRanks = [11,9,8,8]
    $cardRanks = convertToCardRanks([$card11, $card12, $card21, $card22]);

    // (例) $playerCardRanks = [11,9],[8,8]
    $playerCardRanks = array_chunk($cardRanks, 2);

    // (例) $hands = [['HIGH_CARD','1','11','9'],['PAIR','2','8','8']]
    $hands = array_map(fn ($playerCardRank) => checkHand($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);

    $winner = decideWinner($hands[0], $hands[1]);
    return [$hands[0]['name'], $hands[1]['name'], $winner];
}

/**
 * カードをランクに変換する
 *
 * @param array $cards 自分と相手のカード
 * @return array カードランク
 */
function convertToCardRanks(array $cards): array
{
    return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

/**
 * 2枚1組み形式となっているトランプカードを
 * 役の名前と役のランクと高いカードと低いカードに変換する
 * （例）input:[11,9] output:['HIGH_CARD','1','11','9']
 *
 * @param integer $cardRank1
 * @param integer $cardRank2
 * @return array 役の名前と役のランクと高いカードと低いカード
 */
function checkHand(int $cardRank1, int $cardRank2): array
{
    $primary = max($cardRank1, $cardRank2);
    $secondary = min($cardRank1, $cardRank2);
    $name = HIGH_CARD;

    if (isStraight($cardRank1, $cardRank2)) {
        $name = STRAIGHT;
        if (isMinMax($cardRank1, $cardRank2)) {
            $primary = min(CARD_RANK);
            $secondary = max(CARD_RANK);
        }
    } elseif (isPair($cardRank1, $cardRank2)) {
        $name = PAIR;
    }

    return [
        'name' => $name,
        'rank' => HAND_RANK[$name],
        'primary' => $primary,
        'secondary' => $secondary,
    ];
}

/**
 * ストレートか判定する
 *
 * @param integer $cardRank1
 * @param integer $cardRank2
 * @return boolean ストレートのカード
 */
function isStraight(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === 1 || isMinMax($cardRank1, $cardRank2);
}

/**
 * カードのランクを差が12だった場合の処理
 *
 * @param integer $cardRank1
 * @param integer $cardRank2
 * @return boolean カード2枚
 */
function isMinMax(int $cardRank1, int $cardRank2): bool
{
    return abs($cardRank1 - $cardRank2) === (max(CARD_RANK) - min(CARD_RANK));
}

/**
 * ペアーか判定する
 *
 * @param integer $cardRank1
 * @param integer $cardRank2
 * @return boolean ペアのカード
 */
function isPair(int $cardRank1, int $cardRank2): bool
{
    return $cardRank1 === $cardRank2;
}

/**
 * 勝者を判定
 *
 * @param array $hand1
 * @param array $hand2
 * @return integer 勝者の数字
 */
function decideWinner(array $hand1, array $hand2): int
{
    foreach (['rank', 'primary', 'secondary'] as $k) {
        if ($hand1[$k] > $hand2[$k]) {
            return 1;
        }
        if ($hand1[$k] < $hand2[$k]) {
            return 2;
        }
    }
    return 0;
}
