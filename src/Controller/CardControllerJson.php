<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;

class CardControllerJson
{
    /**
    * @Route(
    * "card/api/deck",
    * name="card_api",
    * methods={"GET"})
     */
    public function deckApi(): Response
    {
        $deck = new Deck();
        $jsonDeck = [];
        foreach ($deck->deck as $card) {
            $jsonDeck[] = ['value' => $card->getValue(), 'suit' => $card->getColor()];
        }
        $data = [
            'deck' => $jsonDeck,
        ];

        return new JsonResponse($data);
    }
}
