<?php

namespace App\Card;


/**
* The rules for a  Texas Hold'em game
*/
class TexasRules
{
    /** @var boolean $playerSuits as flush or not. */
    private $playerFlush;
    /** @var boolean $dealerFlush as flush or not. */
    private $dealerFlush;
    /** @var array<int, int> $playerValues as the players hand. */
    private $playerValues;
    /** @var array<int, int> $dealerValues as the dealers hand. */
    private $dealerValues;

    /**
    * Constructor.
    * @param array<int, Card> $player as the players hand.
    * @param array<int, Card> $dealer as the dealers hand.
    */
    public function __construct($player, $dealer)
    {
        $this->playerFlush = $this->isFlush($player);
        $this->dealerFlush = $this->isFlush($dealer);
        //var_dump($this->playerFlush, $this->dealerFlush); exit;

    }

    /**
    * Check if hand is a flush.
    * @param array<int, Card> $hand as the hand.
    * @return boolean
    */
    private function isFlush($hand)
    {
        $temp = array();
        foreach ($hand as $card) {
            $temp[] = $card->getColor();
        }
        return (count(array_unique($temp)) === 1);
    }
}
