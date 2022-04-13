<?php

namespace App\Card;

class Player
{
    /*
    * @var Card[]
    */
    private $hand = [];

    public function addCardToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    /*
    * @return array<Card>
    */
    public function getHand(): array
    {
        return $this->hand;
    }
}
