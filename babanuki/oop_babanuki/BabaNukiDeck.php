<?php

namespace BabaNuki;

require_once('BabaNukiCard.php');

class BabaNukiDeck
{
    private const SUIT = ['ハート', 'ダイヤ', 'クローバー', 'スペード'];

    private const NUMBER = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    private const JOKER = 'ジョーカー';

    private array $deck;


    public function __construct()
    {
        foreach (self::SUIT as $suit) {
            foreach (self::NUMBER as $number) {
                $this->deck[] = new BabaNukiCard($suit, $number);
            }
        }
        $this->deck[] = new BabaNukiCard('', self::JOKER);
        shuffle($this->deck);
    }

    public function drawCard(): BabaNukiCard
    {
        $drawCard = array_splice($this->deck, 0, 1)[0];
        return $drawCard;
    }

    public function getDeck()
    {
        return $this->deck;
    }
}
