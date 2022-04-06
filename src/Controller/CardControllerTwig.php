<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Card\Deck;

class CardControllerTwig extends AbstractController
{
    /**
    * @Route(
    *    "/card",
    *    name="card_home")
     */
    public function card(): Response
    {

        return $this->render('card/card.html.twig');
    }

    /**
    * @Route(
    *    "/card/deck",
    *    name="card_deck")
     */
    public function deck(): Response
    {
        $deck = new Deck();
        $data = [
            'deck_as_string' => $deck->getAsString()
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    /**
    * @Route(
    *    "/card/deck/shuffle",
    *    name="card_deck_shuffle")
     */
    public function shuffle(): Response
    {
        $deck = new Deck();
        $deck->shuffleDeck();
        $data = [
            'deck_as_string' => $deck->getAsString()
        ];

        return $this->render('card/shuffle.html.twig', $data);
    }
}
