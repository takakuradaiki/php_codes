<?php

namespace BabaNuki;

require_once('BabaNukiHand.php');


abstract class Player
{
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new BabaNukiHand();
    }
}
