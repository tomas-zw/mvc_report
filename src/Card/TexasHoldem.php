<?php

namespace App\Card;

use App\Card\TexasRules;

/**
* A Texas Hold'em game
*/
class TexasHoldem
{
    /** @var TexasRules $rules as the rules. */
    private $rules;
    /** @var Deck $deckOfCards as the deck. */
    private $deckOfCards;
    /** @var Player $player as the player. */
    private $player;
    /** @var Bank $dealer as the dealer. */
    private $dealer;
    /** @var array<int, Card> $table as cards on table. */
    private $table;
    /** @var string $message as a message. */
    private $message;
    /** @var boolean $startNewGame as toggle. */
    public $startNewGame;

    /**
    * Constructor to initialize a game of Texas Holdem with a dealer and 1 player.
    * @param Player $player as the player.
    * @param Bank $bank as the dealer.
    */
    public function __construct(Player $player, Bank $bank)
    {
        $this->player = $player;
        $this->dealer = $bank;
        $this->startNewGame = true;
        $this->message = "Welcome";
    }

    /**
    * Get the player.
    * @return Player
    */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
    * Get the message.
    * @return string
    */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
    * Set the message.
    * @param string $msg
    * @return void
    */
    public function setMessage($msg)
    {
        $this->message = $msg;
    }

    /**
    * Get the dealer.
    * @return Bank
    */
    public function getDealer(): Bank
    {
        return $this->dealer;
    }

    /**
    * Get cards on the table.
    * @return array<int, Card> as the hand
    */
    public function getTable()
    {
        return $this->table;
    }

    /**
    * Reset table and both hands
    * @return void
    */
    private function resetTable(): void
    {
        $this->player->resetHand();
        $this->dealer->resetHand();
        $this->table = [];
    }

    /**
    * Start new game
    * @param Deck $deck as the deck of cards.
    * @return void
    */
    public function startGame(Deck $deck): void
    {
        $this->startNewGame = false;
        $this->resetTable();
        $this->deckOfCards = $deck;
        $this->deckOfCards->shuffleDeck();

        $this->table[] = $this->deckOfCards->drawCard();

        for ($i = 0; $i < 2; $i++) {
            $this->player->addCardToHand($this->deckOfCards->drawCard());
            $this->dealer->addCardToHand($this->deckOfCards->drawCard());
            $this->table[] = $this->deckOfCards->drawCard();
        }
    }

    /**
    * Call
    * @return void
    */
    public function call(): void
    {
        for ($i = 0; $i < 2; $i++) {
            $this->table[] = $this->deckOfCards->drawCard();
        }
        $this->startNewGame = true;
    }

    /**
    * Fold
    * @return void
    */
    public function fold(): void
    {
        $this->resetTable();
        $this->startNewGame = true;
    }

    /**
    * Comparare hands and see who won.
    * @return boolean as player won
    */
    public function isPlayerWinner()
    {
        $playerHand = array_merge($this->player->getHand(), $this->table);
        $dealerHand = array_merge($this->dealer->getHand(), $this->table);
        $this->rules = new TexasRules($playerHand, $dealerHand);
        return $this->rules->isWinner();
    }

    /**
    * Get the value from the hand
    * @return
    */
    //public function whoWon(): boolean
}
