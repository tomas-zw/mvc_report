<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class TexasRules.
 */
class TexasRulesTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateTexasRules()
    {
        $value = ['5', '5', '5', '4', '2', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'spades', 'spades',  'spades', 'hearts'];
        $hand = array();
        for ($i = 0; $i < 7; $i++) {
            $hand[] = new Card($value[$i], $suit[$i]);

        }
        $rules = new TexasRules($hand, $hand);
        $this->assertInstanceOf("\App\Card\TexasRules", $rules);

    }

    /**
    * Construct object and verify that the function returns correct boolean 
    * for Quads vs Three of a kind.
     */
    public function testQuads()
    {
        $valuePlayer = ['5', '5', '5', '5', '2', '8', '7'];
        $valuedealer = ['5', '5', '5', '6', '2', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'clubs',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valuedealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());

    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for Full House vs flush
     */
    public function testFullHouse()
    {
        $valuePlayer = ['5', '5', '5', '2', '2', '8', '7'];
        $valuedealer = ['5', '5', '5', '6', '2', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'clubs',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valuedealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for Flush vs three of kind
     */
    public function testFlush()
    {
        $valuePlayer = ['5', '5', '5', '2', '3', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $flush = ['clubs', 'clubs', 'clubs', 'clubs', 'clubs',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $flush[$i]);
            $handDealer[] = new Card($valuePlayer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for straight vs three of kind
     */
    public function testStraight()
    {
        $valuePlayer = ['10', '11', '12', '13', '14', '5', '5'];
        $valueDealer = ['2', '3', '4', '7', '7', '7', '10'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valueDealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for three of a kind vs two pairs
     */
    public function testThreeOfaKind()
    {
        $valuePlayer = ['5', '5', '5', '2', '3', '8', '7'];
        $valueDealer = ['5', '5', '6', '6', '2', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valueDealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for two pairs vs pairs
     */
    public function testTwoPairs()
    {
        $valuePlayer = ['5', '5', '6', '6', '3', '8', '7'];
        $valueDealer = ['5', '5', '4', '9', '2', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valueDealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for pair vs pair
     */
    public function testPairs()
    {
        $valuePlayer = ['5', '5', '6', '10', '3', '8', 'A'];
        $valueDealer = ['5', '5', '6', '10', '3', '8', '7'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $suit[$i]);
            $handDealer[] = new Card($valueDealer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }

    /**
    * Construct object and verify that the function returns correct boolean
    * for all equal but player has flush
     */
    public function testEqualFlush()
    {
        $valuePlayer = ['5', '5', '6', '10', '3', '8', 'A'];
        $suit = ['clubs', 'clubs', 'clubs', 'clubs', 'spades',  'spades', 'hearts'];
        $flush = ['clubs', 'clubs', 'clubs', 'clubs', 'clubs',  'spades', 'hearts'];
        $handPlayer = array();
        $handDealer = array();
        for ($i = 0; $i < 7; $i++) {
            $handPlayer[] = new Card($valuePlayer[$i], $flush[$i]);
            $handDealer[] = new Card($valuePlayer[$i], $suit[$i]);
        }

        $rules = new TexasRules($handPlayer, $handDealer);
        $this->assertTrue($rules->isWinner());

        $rules = new TexasRules($handDealer, $handPlayer);
        $this->assertNotTrue($rules->isWinner());
    }
}
