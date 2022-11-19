<?php

namespace HighLow;

require_once('Player.php');

class HighLowPlayer extends Player
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }
}
