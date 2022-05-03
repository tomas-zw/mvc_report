<?php

namespace App\Card;

/**
* A BlackJack game
*/
class BlackJack
{
    /** @var Deck $deckOfCards as the deck. */
    private $deckOfCards;
    /** @var Player $player as the player. */
    private $player;
    /** @var Bank $bank as the bank. */
    private $bank;
    /** @var Player $currentPlayer as the current player. */
    private $currentPlayer;
    /** @var string $winner as who won. */
    private $winner;
    /** @var bool $drawNewCard as if draw or not. */
    private $drawNewCard;
    /** @var string $playerMsg as a msg linked to the player. */
    private $playerMsg;
    /** @var string $bankMsg as a msg linked to the bank. */
    private $bankMsg;
    /** @var string $winnerMsg as a msg linked to the winner. */
    private $winnerMsg;
    /** @var bool $startNewGame as if start new game or not. */
    private $startNewGame;
    /** @var array<string, string> $suits as represantaion for suit of card. */
    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
    ];

    /**
    * Constructor to initialize a game of BlackJack with a bank an 1 player.
    * @param Player $player as the player.
    * @param Bank $bank as the bank.
    */
    public function __construct(Player $player, Bank $bank)
    {
        $this->player = $player;
        $this->bank = $bank;
        $this->startNewGame = true;
        $this->winner = "";
        $this->playerMsg = "";
        $this->bankMsg = "";
        $this->winnerMsg = "";
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
    * Get the bank.
    * @return Bank
    */
    public function getBank(): Bank
    {
        return $this->bank;
    }

    /**
    * Get the all messages.
    * @return array<string, string>
    */
    public function getMsg()
    {
        return [
            'player' => $this->playerMsg,
            'bank' => $this->bankMsg,
            'winner' => $this->winnerMsg
        ];
    }

    /**
    * Get the suits.
    * @return array<string, string>
    */
    public function getSuits()
    {
        return $this->suits;
    }

    /**
    * Set var if to draw new card or not.
    * @param bool $trueOrFalse as draw or not.
    * @return void
    */
    public function setDrawNewCard(bool $trueOrFalse): void
    {
        $this->drawNewCard = $trueOrFalse;
    }

    /**
    * Set var if to start new game or not.
    * @param bool $trueOrFalse as new game or not.
    * @return void
    */
    public function setStartNewGame(bool $trueOrFalse): void
    {
        $this->startNewGame = $trueOrFalse;
    }

    /**
    * Set var if to change current playr to bank and give bank cards.
    * @return void
    */
    public function noMoreCards(): void
    {
        $this->currentPlayer = $this->bank;
        $this->drawNewCard = true;
        $this->giveBankCards();
    }

    /**
    * Game loop. Checks variables to decide next action.
    * @param Deck $deck as the deck.
    * @return void
    */
    public function playGame(Deck $deck): void
    {
        $this->deckOfCards = $deck;
        $this->deckOfCards->shuffleDeck();

        if ($this->winner || $this->startNewGame) {
            $this->newGame();
        } elseif ($this->drawNewCard) {
            $this->drawNewCard = false;
            if ($this->currentPlayer == $this->player) {
                $this->givePlayerCard();
            // PHPmd doesn't like else
            } elseif ($this->currentPlayer == $this->bank) {
                // } else {
                $this->whoWon();
            }
        }
    }

    /**
    * Checks who won the game.
    * @return void
    */
    private function whoWon(): void
    {
        $bankValue = $this->bank->getHandValue();
        $playerValue = $this->player->getHandValue();
        $this->bankMsg = "Banken har {$bankValue} poäng.\n";
        $this->winner = 'Spelaren';
        if ($bankValue >= $playerValue && $bankValue <= 21) {
            $this->winner = 'Banken';
        }
        $this->winnerMsg = "{$this->winner} vann";
    }

    /**
    * Checks bank rules if to give bank new card or not.
    * @return void
    */
    private function giveBankCards(): void
    {
        while ($this->bank->drawOrNot()) {
            $card = $this->deckOfCards->drawCard();
            if ($card) {
                # $this->bank->addCardToHand($this->deckOfCards->drawCard());
                $this->bank->addCardToHand($card);
            }
        }
    }

    /**
    * Checks player rules if to give player new card or not.
    * @return void
    */
    private function givePlayerCard(): void
    {
        $card = $this->deckOfCards->drawCard();
        if ($card) {
            # $this->player->addCardToHand($this->deckOfCards->drawCard());
            $this->player->addCardToHand($card);
        }
        $currentValue = $this->player->getHandValue();
        $this->playerMsg = "Du har {$currentValue} poäng.\n";
        if ($currentValue > 21) {
            $this->winner = 'Banken';
            $this->winnerMsg = "{$this->winner} vann";
        }
    }

    /**
    * Sets all variables to default state for a new game.
    * @return void
    */
    private function newGame(): void
    {
        $this->winnerMsg = '';
        $this->winner = '';
        $this->startNewGame = false;
        $this->currentPlayer = $this->player;

        $this->player->resetHand();
        $card = $this->deckOfCards->drawCard();
        if ($card) {
            # $this->player->addCardToHand($this->deckOfCards->drawCard());
            $this->player->addCardToHand($card);
        }
        # $this->player->addCardToHand($this->deckOfCards->drawCard());
        $this->drawNewCard = false;

        $this->bank->resetHand();
        $card = $this->deckOfCards->drawCard();
        if ($card) {
            # $this->bank->addCardToHand($this->deckOfCards->drawCard());
            $this->bank->addCardToHand($card);
        }
        # $this->bank->addCardToHand($this->deckOfCards->drawCard());

        $this->playerMsg = "Du har {$this->player->getHandValue()} poäng.\n";
        $this->bankMsg = "Banken har {$this->bank->getHandValue()} poäng.\n";
    }
}
