<?php

namespace App\Card;

use App\Card\Player;

/**
* All game participants.
*/
class Game
{
    /** @var array<int, Player> */
    private $players = [];

    /**
    * Constructor to initialize the game.
    * @param int $nrOfPlayers as players for the game
    */
    public function __construct(int $nrOfPlayers)
    {
        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $this->players[] = new Player();
        }
    }

    /**
    * Get all participants.
    * @return array<int, Player> as nr of players.
    */
    public function getPlayers()
    {
        return $this->players;
    }
}
