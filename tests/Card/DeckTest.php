<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Card\Deck", $deck);
    }

    /**
     * Construct object and verify that the object has 52 cards.
     */
    public function test52Cards()
    {
        $deck = new Deck();
        $this->assertCount(52, $deck->deck);
    }

    /**
     * Construct object and verify that removed card is not still in deck.
     */
    public function testDrawCard()
    {
        $deck = new Deck();
        $card = $deck->drawCard();
        $this->assertNotContains($card, $deck->deck);
    }

    /**
    * Construct object and verify that the order of cards is not
    * the same after shuffling the deck
     */
    public function testShuffleDeck()
    {
        $deck = new Deck();
        $before = $deck->deck[0];
        $deck->shuffleDeck();
        $after = $deck->deck[0];
        $this->assertNotSame($before, $after);
    }
}
