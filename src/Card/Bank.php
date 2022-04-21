<?php

namespace App\Card;

use App\Card\Player;

/**
* A Player but has special rules.
*/
class Bank extends Player
{
    /**
    * Uses Player Constructor to inatialize the object.
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Rule of when the Bank has to stop.
    * @retur bool
    */
    public function drawOrNot(): bool
    {
        if ($this->getHandValue() < 17) {
            return true;
        }
        return false;
    }
}
