<?php

namespace App\Card;

class Player
{
    /** @var array<int, Card> */
    protected $hand;

    public function __construct()
    {
        $this->hand = [];
    }

    public function addCardToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    /** @return array<int, Card> */
    public function getHand()
    {
        return $this->hand;
    }

    public function getHandValue(): int
    {
        $handValueInt = 0;
        foreach ($this->hand as $card) {
            $handValue = $card->getValue();
            switch ($handValue) {
                case 'J':
                    $handValueInt += 10;
                    break;
                case 'Q':
                    $handValueInt += 10;
                    break;
                case 'K':
                    $handValueInt += 10;
                    break;
                case 'A':
                    $handValueInt += 11;
                    break;
                default:
                    $handValueInt += (int) $handValue;
            }
        }
        return $handValueInt;
    }

    public function resetHand(): void
    {
        $this->hand = [];
    }
}
