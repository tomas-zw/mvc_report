<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties.
     */
    public function testCreateDice()
    {
        $value = '5';
        $suit = 'clubs';
        $card = new Card($value, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValue = $card->getValue();
        $this->assertSame($resValue, $value);

        $resSuit = $card->getColor();
        $this->assertSame($resSuit, $suit);
    }
}
