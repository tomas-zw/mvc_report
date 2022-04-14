<?php

namespace App\Card;

use App\Card\Player;

class Bank extends Player
{
    public function __construct()
    {
        parent::__construct();
    }

    public function drawOrNot(): bool
    {
        if ($this->getHandValue() < 17) {
            return true;
        }
        return false;
    }
}
