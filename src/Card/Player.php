<?php

namespace App\Card;

class Player
{
    /** @var array<int, Card> */
    protected $hand = [];

    public function addCardToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    /** @return array<int, Card> */
    public function getHand()
    {
        return $this->hand;
    }

    public function getValue(): int
    {
        $handValue = 0;
        foreach ($this->hand as $card) {
            $handValue += (int) $card->getValue();
        }
        return $handValue;
    }
}
