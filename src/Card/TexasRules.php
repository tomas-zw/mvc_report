<?php

namespace App\Card;

/**
* The rules for a  Texas Hold'em game
*/
class TexasRules
{
    /** @var boolean $playerFlush as flush or not. */
    private $playerFlush;
    /** @var boolean $dealerFlush as flush or not. */
    private $dealerFlush;
    /** @var array<int, int> $playerValues as players hand */
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
        $this->playerValues = $this->getValues($player);
        $this->dealerValues = $this->getValues($dealer);
        //var_dump($this->playerFlush, $this->dealerFlush);
        //var_dump($this->playerValues, $this->dealerValues);
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
        $arr = array_count_values($temp);

        foreach ($arr as $color) {
            if ($color >= 5) {
                return true;
            }
        }
        return false;
    }

    /**
    * Get all values from a hand
    * @param array<int, Card> $hand as the hand.
    * @return array<int, int>
    */
    private function getValues($hand)
    {
        $handValue = array();
        foreach ($hand as $card) {
            $handValue[] = $card->getValueAsInt();
        }
        return $handValue;
    }

    /**
    * Give hands a weight.
    * Quads == 4 * 4
    * Full House == 3 * 3 + 3
    * Flush == 11
    * Straight == 10 TODO
    * Three of a kind == 3 * 3
    * Two pairs == 2 * 2 + 2
    * Pairs == 2 * 2
    * Nothing == 1 * 1
    * @param array<int, int> $hand as sorted array. ex (K K K A A == [3,2])
    * @param boolean $isFlush as true if hand is flush.
    * @return int for hand value
    */
    private function getWeight($hand, $isFlush)
    {
        $handWeight = $hand[0] ** 2;

        if ($hand[0] == 3 && $hand[1] > 1) {
            $handWeight += 3;
        } elseif ($hand[0] == 2 && $hand[1] > 1) {
            $handWeight += 2;
        }

        if ($isFlush) {
            $handWeight = $this->handIsFlush($handWeight);
        }

        return $handWeight;
    }

    /**
    * check if flush is the highest weight.
    * @param int $weight as current weight
    * @return int as the new weight
    */
    private function handIsFlush($weight)
    {
        if ($weight < 11) {
            return 11;
        }
        return $weight;
    }

    /**
    * Compare hands with equal weighted value.
    * arrays need to be sorted by value and key.
    * @param array<int, int> $player as < value, occurrences>
    * @param array<int, int> $dealer as < value, occurrences>
    * @return boolean true if player won.
    */
    public function equalWeight($player, $dealer)
    {
        $playerKeys = array_keys($player);
        $dealerKeys = array_keys($dealer);
        $lowestIndex = count($playerKeys);

        if (count($dealerKeys) < $lowestIndex) {
            $lowestIndex = count($dealerKeys);
        }

        for ($i = 0; $i < $lowestIndex; $i++) {
            if ($playerKeys[$i] == $dealerKeys[$i]) {
                continue;
            }
            return ($playerKeys[$i] > $dealerKeys[$i]);
        }
        // if empty array
        return true;
    }

    /**
    * Compare weighted hands.
    * @return boolean true if player won.
    */
    public function isWinner()
    {
        $player = array_count_values($this->playerValues);
        $dealer = array_count_values($this->dealerValues);
        krsort($player);
        krsort($dealer);
        arsort($player);
        arsort($dealer);
        $playerOnlyCount = array_values($player);
        $dealerOnlyCount = array_values($dealer);
        $playerWon = false;

        $playerWeight = $this->getWeight($playerOnlyCount, $this->playerFlush);
        $dealerWeight = $this->getWeight($dealerOnlyCount, $this->dealerFlush);

        if ($playerWeight > $dealerWeight) {
            $playerWon = true;
        } elseif ($playerWeight == $dealerWeight) {
            $playerWon = $this->equalWeight($player, $dealer);
        }
        //var_dump($player, $playerOnlyCount, $playerWeight, $dealerWeight); exit;
        return $playerWon;
    }
}
