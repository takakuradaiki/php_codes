<?php

namespace BabaNuki;

class BabaNukiHand
{
    private array $hand = [];

    public function addHand(BabaNukiCard $card)
    {
        $this->hand[] = $card;
    }

    public function getHand()
    {
        return $this->hand;
    }
}
