<?php

namespace App\Entity;

use App\Repository\TexasHoldemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TexasHoldemRepository::class)]
class TexasHoldem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $rounds;

    #[ORM\Column(type: 'integer')]
    private $winnings;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRounds(): ?int
    {
        return $this->rounds;
    }

    public function setRounds(int $rounds): self
    {
        $this->rounds = $rounds;

        return $this;
    }

    public function getWinnings(): ?int
    {
        return $this->winnings;
    }

    public function setWinnings(int $winnings): self
    {
        $this->winnings = $winnings;

        return $this;
    }
}
