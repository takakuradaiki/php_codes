<?php

namespace BabaNuki;

class BabaNukiCard
{
    public function __construct(string $suit, string $number)
    {
        $this->suit = $suit;
        $this->number = $number;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number)
    {
        $this->number = $number;
    }
}
