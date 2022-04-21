<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Bank extends Player.
 */
class BankTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties. Add cards so value of hand < int:17. Return from
     * drawOrNot() should return true.
     */
    public function testValueSub17()
    {
        $bank = new Bank();
        $this->assertInstanceOf("\App\Card\Bank", $bank);

        $suit = 'clubs';
        $jack = new Card('J', $suit);
        $bank->addCardToHand($jack);

        $three = new Card('3', $suit);
        $bank->addCardToHand($three);

        $this->assertTrue($bank->drawOrNot()); 
    }

    /**
     * Construct object and verify that the object has the expected
     * properties. Add cards so value of hand > int:17. Return from
     * drawOrNot() should return false.
     */
    public function testValueOver16()
    {
        $bank = new Bank();
        $this->assertInstanceOf("\App\Card\Bank", $bank);

        $suit = 'clubs';
        $jack = new Card('J', $suit);
        $bank->addCardToHand($jack);

        $three = new Card('7', $suit);
        $bank->addCardToHand($three);

        $this->assertNotTrue($bank->drawOrNot()); 
    }
}
