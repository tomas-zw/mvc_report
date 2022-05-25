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
        $intValue = 5;
        $suit = 'clubs';
        $card = new Card($value, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValue = $card->getValue();
        $this->assertSame($resValue, $value);

        $resSuit = $card->getColor();
        $this->assertSame($resSuit, $suit);

        $resValueInt = $card->getValueAsInt();
        $this->assertSame($resValueInt, $intValue);
    }

    /**
    * Construct object and verify that the object returns correct value
    * for A, K, Q, and J
     */
    public function testJtoA()
    {
        $suit = 'clubs';

        $jack = 'J';
        $jackInt = 11;

        $queen = 'Q';
        $queenInt = 12;

        $king = 'K';
        $kingInt = 13;

        $ace = 'A';
        $aceInt = 14;

        $card = new Card($jack, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValueInt = $card->getValueAsInt();
        $this->assertSame($resValueInt, $jackInt);

        $card = new Card($queen, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValueInt = $card->getValueAsInt();
        $this->assertSame($resValueInt, $queenInt);

        $card = new Card($king, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValueInt = $card->getValueAsInt();
        $this->assertSame($resValueInt, $kingInt);

        $card = new Card($ace, $suit);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $resValueInt = $card->getValueAsInt();
        $this->assertSame($resValueInt, $aceInt);



    }
}
