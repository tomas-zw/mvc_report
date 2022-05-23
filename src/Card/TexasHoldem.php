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
    protected $table;

    /**
    * Constructor to initialize a game of Texas Holdem with a dealer and 1 player.
    * @param Player $player as the player.
    * @param Bank $bank as the dealer.
    */
    public function __construct(Player $player, Bank $bank, Deck $deck)
    {
        $this->player = $player;
        $this->dealer = $bank;
        $this->deckOfCards = $deck;
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
    * Start new game
    * @return void
    */
    public function startGame(): void
    {
        $card = $this->deckOfCards->drawCard();
        $this->player->addCardToHand($card);
        $this->player->addCardToHand($card);

        $this->dealer->addCardToHand($card);
        $this->dealer->addCardToHand($card);

        $this->table[0] = $card;
        $this->table[1] = $card;
        $this->table[2] = $card;
        $this->table[3] = $card;
        $this->table[4] = $card;
    }

}
