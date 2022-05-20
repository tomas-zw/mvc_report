<?php

namespace App\Card;

use App\Card\Card;

/**
* A deck of cards.
*/
class Deck
{
    /** @var array<int, Card> */
    public $deck = [];

    /** @var array<string, string> */
    public $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
        'blank' => '✱',
        'joker' => '🃏',
    ];

    /** @var array<int, string> */
    private $colors = ['clubs', 'diamonds', 'hearts', 'spades'];

    /** @var array<int, string> */
    private $values = ['2', '3', '4', '5','6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    /**
    * Constructor to initialize a Deck of cards.
    * The Deck has 52 cards and no duplicates.
    */
    public function __construct()
    {
        foreach ($this->colors as $color) {
            foreach ($this->values as $value) {
                $this->addCard($value, $color);
            }
        }
    }

    /**
    * Remove the last card from the deck and return it.
    * @return Card | null as a card, or null if deck is empty.
    */
    public function drawCard(): Card | null
    {
        return array_pop($this->deck);
    }

    /**
    * Shuffle the existing deck.
    * @return void
    */
    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    /**
    * Add new card to existing deck.
    * @param string $value as value of the card.
    * @param string $color as suit of the card.
    * @return void
    */
    protected function addCard(string $value, string $color): void
    {
        $card = new Card($value, $color);
        $this->deck[] = $card;
    }
}
