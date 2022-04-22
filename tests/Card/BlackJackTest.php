<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BlackJack.
 */
class BlackJackTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateBlackJack()
    {
        $player = new Player();
        $bank = new Bank();

        $blackJack = new BlackJack($player, $bank);
        $this->assertInstanceOf("\App\Card\BlackJack", $blackJack);
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. arg player sholud be same object as returned from
    * getPlayer()
     */
    public function testGetPlayer()
    {
        $player = new Player();
        $bank = new Bank();

        $blackJack = new BlackJack($player, $bank);
        $this->assertSame($player, $blackJack->getPlayer());
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. arg bank sholud be same object as returned from
    * getBank()
     */
    public function testGetBank()
    {
        $player = new Player();
        $bank = new Bank();

        $blackJack = new BlackJack($player, $bank);
        $this->assertSame($bank, $blackJack->getBank());
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. Expect an associative array with 3 empty strings
     */
    public function testGetMsg()
    {
        $player = new Player();
        $bank = new Bank();

        $blackJack = new BlackJack($player, $bank);
        $threeMsg = $blackJack->getMsg();
        $this->assertSame($threeMsg['player'], '');
        $this->assertSame($threeMsg['bank'], '');
        $this->assertSame($threeMsg['winner'], '');
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. Expect an associative array with the keys
    * 'hearts', 'diamonds', 'clubs', 'spades'.
     */
    public function testGetSuits()
    {
        $player = new Player();
        $bank = new Bank();

        $blackJack = new BlackJack($player, $bank);
        $threeMsg = $blackJack->getSuits();
        $this->assertArrayHasKey('hearts', $threeMsg);
        $this->assertArrayHasKey('diamonds', $threeMsg);
        $this->assertArrayHasKey('clubs', $threeMsg);
        $this->assertArrayHasKey('spades', $threeMsg);
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. Start new game, Player draws one card -> bank gets cards.
    * Expect an associative array with the key 'winnerMsg' to contain 'Banken'
    * if Bank handvalue > player handvalue or player handvalue > 21
    * if bank handvalue > 21 expect 'winnermsg' to contain 'Spelaren'
     */
    public function testPlayerTakesOneCard()
    {
        $player = new Player();
        $bank = new Bank();
        $deck = new Deck();
        $blackJack = new BlackJack($player, $bank);

        $blackJack->playGame($deck);
        $blackJack->setDrawNewCard(true);
        $blackJack->playGame($deck);
        $threeMsg = $blackJack->getMsg();

        if ($player->getHandValue() > 21) {
            $this->assertStringContainsString('Banken', $threeMsg['winner']);
        } else {
            $blackJack->noMoreCards();
            $blackJack->playGame($deck);
            $threeMsg = $blackJack->getMsg();

            if ($bank->getHandValue() > 21) {
                $this->assertStringContainsString('Spelaren', $threeMsg['winner']);
            } elseif ($bank->getHandValue() >= $player->getHandValue()) {
                $this->assertStringContainsString('Banken', $threeMsg['winner']);
            }
        }
    }

    /**
     * Construct object and verify that the object has the expected
    * properties. Start new game, Player stops at one card -> bank gets cards.
    * Expect an associative array with the key 'winnerMsg' to contain 'Banken'
    * if Bank handvalue > player handvalue.
    * if bank handvalue > 21 expect 'winnermsg' to contain 'Spelaren'
     */
    public function testBankWon()
    {
        $player = new Player();
        $bank = new Bank();
        $deck = new Deck();
        $blackJack = new BlackJack($player, $bank);

        $blackJack->playGame($deck);
        $blackJack->noMoreCards();
        $blackJack->playGame($deck);
        $threeMsg = $blackJack->getMsg();

        if ($bank->getHandValue() > 21) {
            $this->assertStringContainsString('Spelaren', $threeMsg['winner']);
        } elseif ($bank->getHandValue() >= $player->getHandValue()) {
            $this->assertStringContainsString('Banken', $threeMsg['winner']);
        }
    }
}
