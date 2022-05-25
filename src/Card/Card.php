<?php

namespace App\Card;

/**
* A playing card.
*/
class Card
{
    /** @var string $value The value of the card. */
    private $value;

    /** @var string $color The suit of the card. */
    private $color;

    /**
    * Constructor to initialize a card.
    * @param string $value as value of card.
    * @param string $color as suit of card.
    */
    public function __construct(string $value, string $color)
    {
        $this->value = $value;
        $this->color = $color;
    }

    /**
    * Get the value of the card.
    * @return string as the value of the card.
    */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
    * Get the value of the card.
    * @return int as the value of the card.
    */
    public function getValueAsInt(): int
    {
        $handValueInt = 0;
        $handValue = $this->value;
        switch ($handValue) {
            case 'J':
                $handValueInt = 11;
                break;
            case 'Q':
                $handValueInt = 12;
                break;
            case 'K':
                $handValueInt = 13;
                break;
            case 'A':
                $handValueInt = 14;
                break;
            default:
                $handValueInt = (int) $handValue;
        }
        return $handValueInt;
    }

    /**
    * Get the suit of the card.
    * @return string as the suit of the card.
    */
    public function getColor(): string
    {
        return $this->color;
    }
}
