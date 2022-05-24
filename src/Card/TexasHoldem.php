<?php

namespace App\Card;

/**
* A Texas Hold'em game
*/
class TexasHoldem
{
    /** @var Deck $deckOfCards as the deck. */
    private $deckOfCards;
    /** @var Player $player as the player. */
    private $player;
    /** @var Bank $dealer as the dealer. */
    private $dealer;
    /** @var array<int, Card>  as cards on table. */
    private $table;
    /** @var startNewGame as toggle. */
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

}
