<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
    * Construct object and verify that the object has the expected
    * properties. The array of players should be same length as int:arg passed
    * in constructor.
    */
    public function testCreateGame()
    {
        $nrOfPlayers = 2;
        $game = new Game($nrOfPlayers);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $players = $game->getPlayers();
        $this->assertCount($nrOfPlayers, $players);
    }
}
