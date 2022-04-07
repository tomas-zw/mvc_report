<?php

namespace App\Card;

class Player
{
    private $hand = [];

    public function addCardToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getHand(): array
    {
        return $this->hand;
    }
}
