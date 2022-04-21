<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Player hand should be empty.
     */
    public function testCreatePlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $hand = $player->getHand();
        $this->assertCount(0, $hand);
    }

    /**
    * Construct object and verify that the object has the expected
    * properties. Add cards and the nr of cards in the hand should match
    * the nr of cards added.
    */
    public function testAddCard()
    {
        $player = new Player();
        $card = new Card('K', 'clubs');

        for ($x = 1; $x <= 5; $x++) {
            $player->addCardToHand($card);
            $hand = $player->getHand();
            $this->assertCount($x, $hand);
        }

    }

    /**
    * Construct object and verify that the object has the expected
    * properties. Add cards and then reset the hand.
    * nr of cards in hand should now be int:0
    */
    public function testResetHand()
    {
        $player = new Player();
        $card = new Card('K', 'clubs');

        for ($x = 1; $x <= 5; $x++) {
            $player->addCardToHand($card);
        }

        $player->resetHand();
        $hand = $player->getHand();
        $this->assertCount(0, $hand);

    }

    /**
    * Construct object and verify that the object has the expected
    * properties.
    * Value retured of cards with the value of 'J','Q','K' sholud be int:10.
    * 'A' should return int:11
    */
    public function testGetHandValue()
    {
        $player = new Player();
        $suit = 'clubs';

        $jack = new Card('J', $suit);
        $player->addCardToHand($jack);
        $this->assertEquals(10, $player->getHandValue());
        $player->resetHand();

        $queen = new Card('Q', $suit);
        $player->addCardToHand($queen);
        $this->assertEquals(10, $player->getHandValue());
        $player->resetHand();

        $king = new Card('K', $suit);
        $player->addCardToHand($king);
        $this->assertEquals(10, $player->getHandValue());
        $player->resetHand();

        $ace = new Card('A', $suit);
        $player->addCardToHand($ace);
        $this->assertEquals(11, $player->getHandValue());
        $player->resetHand();
    }

    /**
    * Construct object and verify that the object has the expected
    * properties.
    * Add cards and the total handvalue should equal the total value of the
    * cards.
    * 'J', '3', '9' added expect return of int:22
    */
    public function testGetHandValueOf3Cards()
    {
        $player = new Player();
        $suit = 'clubs';

        $jack = new Card('J', $suit);
        $player->addCardToHand($jack);

        $three = new Card('3', $suit);
        $player->addCardToHand($three);

        $nine = new Card('9', $suit);
        $player->addCardToHand($nine);

        $this->assertEquals(22, $player->getHandValue());
    }
}
