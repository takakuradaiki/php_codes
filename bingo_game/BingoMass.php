<?php

namespace BingoBallGame;

class BingoMass
{

    private int $number;
    private bool $flag = false;
    private string $displayNumber;


    public function __construct($randomNumber)
    {
        $this->number = $randomNumber;
        $this->displayNumber = $randomNumber;
        if ($randomNumber === 76) {
            $this->displayNumber = 'free';
            $this->flag = true;
        }
    }

    public function setFlag()
    {
        $this->flag = true;
    }

    public function getDisplayNumber()
    {
        return $this->displayNumber;
    }
    public function setDisplayNumber($ball)
    {
        $this->displayNumber = '(' . $ball . ')';
    }

    public function getNumber()
    {
        return $this->number;
    }
}
