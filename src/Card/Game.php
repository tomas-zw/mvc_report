<?php

namespace App\Card;

use App\Card\Player;

class Game
{
    private $players = [];

    public function __construct(int $nrOfPlayers)
    {
        for ($i = 0; $i < $nrOfPlayers; $i++) {
            $this->players[] = new Player();
        }
    }

    public function getPlayers(): array
    {
        return $this->players;
    }
}
