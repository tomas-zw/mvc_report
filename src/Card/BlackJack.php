<?php

namespace App\Card;

class BlackJack
{
    private Deck $deckOfCards;
    private Player $player;
    private Bank $bank;
    private Player $currentPlayer;
    private bool $drawNewCard;
    private string $msg;

    public function __construct(Player $player, Bank $bank)
    {
        $this->player = $player;
        $this->bank = $bank;
    }

    public function addDeck(Deck $deck): void
    {
        $this->deckOfCards = $deck;
    }

    public function newGame(Deck $deck): void
    {
        $this->deckOfCards = $deck;
        $this->deckOfCards->shuffleDeck();
        $this->currentPlayer = $this->player;

        $this->player->resetHand();
        $this->player->addCardToHand($this->deckOfCards->drawCard());
        $this->drawNewCard = false;

        $this->bank->resetHand();
        $this->bank->addCardToHand($this->deckOfCards->drawCard());

        $this->msg = "Du har ${$this->player->getHandValue()} poang.\n";
    }
}
