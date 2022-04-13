<?php

namespace App\Card;

use App\Card\Deck;

class DeckWith2Jokers extends Deck
{
    /** @var array<int, string> */
    private $jokers = ['joker', 'joker'];

    public function __construct()
    {
        parent::__construct();
        foreach ($this->jokers as $joker) {
            parent::addCard($joker, $joker);
        }
    }
}
