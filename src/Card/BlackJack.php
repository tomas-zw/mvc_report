<?php

namespace App\Card;

class BlackJack
{
    private Deck $deckOfCards;
    private Player $player;
    private Bank $bank;
    private Player $currentPlayer;
    private bool $drawNewCard;
    private string $playerMsg;
    private string $bankMsg;
    private bool $startNewGame;
    /** @var array<string, string> */
    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
    ];

    public $counter = 0;
    private string $errorMsg = '';

    public function __construct(Player $player, Bank $bank)
    {
        $this->player = $player;
        $this->bank = $bank;
        $this->startNewGame = true;
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
            'error' => $this->errorMsg
        ];
    }

    /** @return array<string, string> */
    public function getSuits()
    {
        return $this->suits;
    }

    public function setDrawNewCard(bool $trueOrFalse): void
    {
        $this->errorMsg = 'setDrawNewCard';
        $this->drawNewCard = $trueOrFalse;
        // if (strcmp($trueOrFalse, 'true') == 0){
        //     $this->drawNewCard = true;
        // } else {
        //     $this->drawNewCard = false;
        // }
    }

    public function setStartNewGame(bool $trueOrFalse): void
    {
        $this->startNewGame = $trueOrFalse;
    }

    public function playGame(Deck $deck): void
    {
        $this->deckOfCards = $deck;
        $this->deckOfCards->shuffleDeck();

        if ($this->startNewGame) {
            $this->newGame();
            $this->counter = 0;
        }
        if ($this->currentPlayer == $this->player){
            if ($this->drawNewCard) {
                $this->counter += 1;
                $this->givePlayerCard();
            }
        }
    }

    private function givePlayerCard(): void
    {
        $this->player->addCardToHand($this->deckOfCards->drawCard());
        $this->playerMsg = "Du har {$this->player->getHandValue()} poäng.\n";
        $this->drawNewCard = false;
    }

    public function newGame(): void
    {
        $this->errorMsg = 'newGame';
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
