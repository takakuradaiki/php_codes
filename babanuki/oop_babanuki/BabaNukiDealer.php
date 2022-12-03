<?php

namespace BabaNuki;

require_once('Player.php');

class BabaNukiDealer extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
    public function drawCard(BabaNukiDeck $deck)
    {
        $card = $deck->drawCard();
        $this->addHand($card);
    }
    public function addHand(BabaNukiCard $card)
    {
        $this->hand->addHand($card);
    }
}
