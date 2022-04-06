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

    // public function add(Dice $die): void
    // {
    //     $this->hand[] = $die;
    // }
    //
    // public function getAsHtml(): string
    // {
    //     foreach ($this->hand as $die) {
    //         $die->roll();
    //     }
    // }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function getAsString(): string
    {
        $str = "";
        foreach ($this->deck as $card) {
            $str .= $card->getAsString();
        }
        return $str;
    }
}

