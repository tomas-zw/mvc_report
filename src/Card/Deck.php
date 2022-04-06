<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    public $deck = [];
    // private $deck = [];
    private $colors = ['clubs', 'diamonds', 'hearts', 'spades'];
    private $values = ['2', '3', '4', '5','6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    public function __construct()
    {
        foreach ($this->colors as $color) {
            foreach ($this->values as $value) {
                $card = new Card($value, $color);
                $this->deck[] = $card;
            }
        }
    }

    public function drawCard(): Card | Null
    {
        return array_pop($this->deck);
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }
}
