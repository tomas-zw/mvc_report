<?php

namespace App\Card;

/**
* A player for card games.
*/
class Player
{
    /** @var array<int, Card> */
    protected $hand;

    /**
    * Constructor to initialize a player with empty hand of cards.
    */
    public function __construct()
    {
        $this->hand = [];
    }

    /**
    * Add a new card to the hand.
    * @param Card $card as a new card.
    * @return void
    */
    public function addCardToHand(Card $card): void
    {
        $this->hand[] = $card;
    }

    /**
    * Get the hand.
    * @return array<int, Card> as the hand
    */
    public function getHand()
    {
        return $this->hand;
    }

    /**
    * Get the value of the hand.
    * Maps 'j','Q','K' to 10
    * Maps 'A' to 11
    * @return int as the value of the hand.
    */
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

    /**
    * Resets current hand to an empty hand.
    * @return void
    */
    public function resetHand(): void
    {
        $this->hand = [];
    }
}
