<?php

namespace App\Card;

use App\Card\Player;

class Game
{
    /** @var array<int, Player> */
    private $players = [];

    public function __construct(int $nrOfPlayers)
    {
        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $this->players[] = new Player();
        }
    }

    /** @return array<int, Player> */
    public function getPlayers()
    {
        return $this->players;
    }
}
