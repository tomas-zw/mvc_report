<?php

namespace App\Card;

use App\Card\Deck;

/**
* A Deck with 2 extra cards
*/
class DeckWith2Jokers extends Deck
{
    /** @var array<int, string> */
    private $jokers = ['joker', 'joker'];

    /**
    * Uses parent Constructor to initialize a Deck of cards.
    * Then adds 2 extra 'joker' to the deck
    * The deck has 54 cards.
    */
    public function __construct()
    {
        parent::__construct();
        foreach ($this->jokers as $joker) {
            parent::addCard($joker, $joker);
        }
    }
}
