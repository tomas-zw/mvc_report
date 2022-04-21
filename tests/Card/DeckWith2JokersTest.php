<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckWith2Jokers.
 */
class DeckWith2JokersTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function createDeckWith2Jokers()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\DeckWith2Jokers", $deck);
    }

    /**
     * Construct object and verify that the object has the expected
     * 54 cards.
     */
    public function test54Cards()
    {
        $deck = new DeckWith2Jokers();
        $this->assertCount(54, $deck->deck);
    }

    /**
     * Construct object and verify that the object has 2 'joker' cards
     * at the end of the deck.
     */
    public function test2Jokers()
    {
        $deck = new DeckWith2Jokers();
        for ($x = 0; $x <=1; $x++) {
            $card = $deck->drawCard();
            $value = $card->getValue();
            $suit = $card->getColor();
            $this->assertSame($value, $suit);
            $this->assertSame('joker', $suit);
        }
    }
}
