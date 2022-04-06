<?php

namespace App\Card;

class Card
{
    private $value;
    private $color;

    public function __construct(string $value, string $color)
    {
        $this->value = $value;
        $this->color = $color;
    }

    // public function roll(): int
    // {
    //     $this->value = random_int(1, 6);
    //     return $this->value;
    // }
    //
    public function getAsString(): string
    {
        return "{$this->value} {$this->color}";
    }
}
