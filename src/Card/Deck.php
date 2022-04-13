<?php

namespace App\Card;

use App\Card\Card;

class Deck
{
    // private $deck = [];

    /** @var array<int, Card> */
    public $deck = [];
    /** @var array<int, string> */
    private $colors = ['clubs', 'diamonds', 'hearts', 'spades'];
    /** @var array<int, string> */
    private $values = ['2', '3', '4', '5','6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    public function __construct()
    {
        foreach ($this->colors as $color) {
            foreach ($this->values as $value) {
                $this->addCard($value, $color);
            }
        }
    }

    public function drawCard(): Card | null
    {
        return array_pop($this->deck);
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    protected function addCard(string $value, string $color): void
    {
        $card = new Card($value, $color);
        $this->deck[] = $card;
    }
}
