<?php

namespace App\Card;

class BlackJack
{
    private Deck $deckOfCards;
    private Player $player;
    private Bank $bank;
    private Player $currentPlayer;
    private string $winner;
    private bool $drawNewCard;
    private string $playerMsg;
    private string $bankMsg;
    private string $winnerMsg;
    private bool $startNewGame;
    /** @var array<string, string> */
    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
    ];


    public function __construct(Player $player, Bank $bank)
    {
        $this->player = $player;
        $this->bank = $bank;
        $this->startNewGame = true;
        $this->winner = "";
        $this->winnerMsg = "";
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getBank(): Bank
    {
        return $this->bank;
    }

    public function getCurrentPlayer(): Player
    {
        return $this->currentPlayer;
    }

    /** @return array<string, string> */
    public function getMsg()
    {
        return [
            'player' => $this->playerMsg,
            'bank' => $this->bankMsg,
            'winner' => $this->winnerMsg
        ];
    }

    /** @return array<string, string> */
    public function getSuits()
    {
        return $this->suits;
    }

    public function setDrawNewCard(bool $trueOrFalse): void
    {
        $this->drawNewCard = $trueOrFalse;
    }

    public function setStartNewGame(bool $trueOrFalse): void
    {
        $this->startNewGame = $trueOrFalse;
    }

    public function noMoreCards(): void
    {
        $this->currentPlayer = $this->bank;
        $this->drawNewCard = true;
        $this->giveBankCards();
    }

    public function playGame(Deck $deck): void
    {
        $this->deckOfCards = $deck;
        $this->deckOfCards->shuffleDeck();

        if ($this->winner || $this->startNewGame) {
            $this->newGame();
        } elseif ($this->drawNewCard) {
            if ($this->currentPlayer == $this->player) {
                $this->givePlayerCard();
            } else {
                $this->whoWon();
            }
        }
    }

    private function whoWon(): void
    {
        $bankValue = $this->bank->getHandValue();
        $playerValue = $this->player->getHandValue();
        $this->bankMsg = "Banken har {$bankValue} poäng.\n";
        if ($bankValue > 21) {
            $this->winner = 'Spelaren';
        } elseif ($bankValue >= $playerValue) {
            $this->winner = 'Banken';
        } else {
            $this->winner = 'Spelaren';
        }
        $this->winnerMsg = "{$this->winner} vann";
    }

    private function giveBankCards(): void
    {
        while ($this->bank->drawOrNot()) {
            $this->bank->addCardToHand($this->deckOfCards->drawCard());
        }
    }

    private function givePlayerCard(): void
    {
        $this->player->addCardToHand($this->deckOfCards->drawCard());
        $currentValue = $this->player->getHandValue();
        $this->playerMsg = "Du har {$currentValue} poäng.\n";
        if ($currentValue > 21) {
            $this->winner = 'Banken';
            $this->winnerMsg = "{$this->winner} vann";
        }
    }

    private function newGame(): void
    {
        $this->winnerMsg = '';
        $this->winner = '';
        $this->startNewGame = false;
        $this->currentPlayer = $this->player;

        $this->player->resetHand();
        $this->player->addCardToHand($this->deckOfCards->drawCard());
        $this->drawNewCard = false;

        $this->bank->resetHand();
        $this->bank->addCardToHand($this->deckOfCards->drawCard());

        $this->playerMsg = "Du har {$this->player->getHandValue()} poäng.\n";
        $this->bankMsg = "Banken har {$this->bank->getHandValue()} poäng.\n";
    }
}
