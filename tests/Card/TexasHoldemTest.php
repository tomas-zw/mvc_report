<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class TexasHoldem.
 */
class TexasHoldemTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateTexasHoldem()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $this->assertInstanceOf("\App\Card\TexasHoldem", $texasHoldem);
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. arg player sholud be same object as returned from
    * getPlayer()
     */
    public function testGetPlayer()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $this->assertSame($player, $texasHoldem->getPlayer());
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. arg bank sholud be same object as returned from
    * getBank()
     */
    public function testGetDealer()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $this->assertSame($dealer, $texasHoldem->getDealer());
    }

    /**
     * Construct object and verify that the object has the expected
    * properties.
     */
    public function testGetMsg()
    {
        $player = new Player();
        $dealer = new Bank();
        $message = "Test if same";

        $texasHoldem = new TexasHoldem($player, $dealer);
        $texasHoldem->setMessage($message);

        $theMsg = $texasHoldem->getMessage();
        $this->assertSame($theMsg, $message);
    }

    /**
    * Construct object and verify that the object has a player and dealer 
    * with 2 cards and a table with 3 cards.
     */
    public function testStartGame()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $texasHoldem->startGame(new Deck());

        $table = $texasHoldem->getTable();
        $playerHand = $player->getHand();
        $dealerHand = $dealer->getHand();

        $this->assertCount(2, $playerHand);
        $this->assertCount(2, $dealerHand);
        $this->assertCount(3, $table);
    }

    /**
    * Construct object and verify that the player, dealer and table are empty
    * after a fold
     */
    public function testFold()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $texasHoldem->startGame(new Deck());
        $texasHoldem->fold();

        $table = $texasHoldem->getTable();
        $playerHand = $player->getHand();
        $dealerHand = $dealer->getHand();

        $this->assertCount(0, $playerHand);
        $this->assertCount(0, $dealerHand);
        $this->assertCount(0, $table);
    }

    /**
    * Construct object and verify that the player and dealer still has 2 cards
    * and table has 5 cards after call.
     */
    public function testCall()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $texasHoldem->startGame(new Deck());
        $texasHoldem->call();

        $table = $texasHoldem->getTable();
        $playerHand = $player->getHand();
        $dealerHand = $dealer->getHand();

        $this->assertCount(2, $playerHand);
        $this->assertCount(2, $dealerHand);
        $this->assertCount(5, $table);
    }

    /**
    * Construct object and verify that the player isPlayerWinner() returns a 
    * boolean
     */
    public function testIsPlayerWinner()
    {
        $player = new Player();
        $dealer = new Bank();

        $texasHoldem = new TexasHoldem($player, $dealer);
        $texasHoldem->startGame(new Deck());
        $texasHoldem->call();
        $trueOrFalse = $texasHoldem->isPlayerWinner();

        $this->assertIsBool($trueOrFalse);
    }
}
