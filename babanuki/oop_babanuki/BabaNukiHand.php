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
    public function unsetHand($key)
    {
        unset($this->hand[$key]);
    }
    public function takeCard($answer)
    {
        $tookCard = array_splice($this->hand, $answer, 1)[0];
        return $tookCard;
    }
    public function putCard($tookCard)
    {
        $this->hand[] = $tookCard;
    }
    public function arrangeHand()
    {
        $this->hand = array_values($this->hand);
        shuffle($this->hand);
    }
}
