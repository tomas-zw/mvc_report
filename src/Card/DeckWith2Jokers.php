<?php

namespace App\Card;

use App\Card\Deck;

class DeckWith2Jokers extends Deck
{
    private $jokers = ['joker', 'joker'];

    public function __construct()
    {
        parent::__construct();
        foreach ($this->jokers as $joker) {
            parent::addCard($joker, $joker);
        }
    }
}
