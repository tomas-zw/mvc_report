<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;
use App\Card\DeckWith2Jokers;
use App\Card\Game;
use App\Card\Player;

class CardControllerTwig extends AbstractController
{
    /** @var array<string, string> */
    public $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
        'blank' => '✱',
        'joker' => '🃏',
    ];

    /**
    * @Route(
    *    "/card",
    *    name="card_home")
     */
    public function card(): Response
    {
        $data = [
            'link_to_draw_number' => $this->generateUrl(
                'card_deck_draw_number',
                ['number' => 3]
            ),
            'link_to_deal' => $this->generateUrl(
                'card_deck_deal',
                ['players' => 4, 'cards' => 5]
            ),
        ];

        return $this->render('card/card.html.twig', $data);
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
            'deck' => $deck,
            'suits' => $this->suits
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    /**
    * @Route(
    *    "/card/deck2",
    *    name="card_deck_2")
     */
    public function deck2(): Response
    {
        $deck = new DeckWith2Jokers();
        $data = [
            'deck' => $deck,
            'suits' => $this->suits
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    /**
    * @Route(
    *    "/card/deck/shuffle",
    *    name="card_deck_shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new Deck();
        $session->set('deck', $deck);
        $deck->shuffleDeck();
        $data = [
            'deck' => $deck,
            'suits' => $this->suits
        ];

        return $this->render('card/shuffle.html.twig', $data);
    }

    /**
    * @Route(
    *    "/card/deck/draw",
    *    name="card_deck_draw")
     */
    public function draw(SessionInterface $session): Response
    {
        $deck = $session->get('deck') ?? new Deck();
        $deck->shuffleDeck();
        $card = $deck->drawCard();
        $session->set('deck', $deck);
        $data = [
            'deck' => $deck,
            'card' => $card,
            'suits' => $this->suits
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    /**
    * @Route(
    *    "/card/deck/draw/{number}",
    *    name="card_deck_draw_number")
     */
    public function drawNumber(int $number, SessionInterface $session): Response
    {
        $cards = [];
        $deck = $session->get('deck') ?? new Deck();
        $deck->shuffleDeck();
        $maxNumber = count($deck->deck);
        if ($number > $maxNumber) {
            $number = $maxNumber;
        }
        for ($i = 0; $i < $number; $i++) {
            $cards[] = $deck->drawCard();
        }
        $session->set('deck', $deck);
        $data = [
            'deck' => $deck,
            'cards' => $cards,
            'suits' => $this->suits
        ];

        return $this->render('card/drawNumber.html.twig', $data);
    }
    /**
    * @Route(
    *    "/card/deck/deal/{players}/{cards}",
    *    name="card_deck_deal")
     */
    public function deal(int $players, int $cards): Response
    {
        $game = new Game($players);
        $deck = new Deck();
        $validGame = false;
        if (($players * $cards) <= count($deck->deck)) {
            $validGame = true;
            $deck->shuffleDeck();
            foreach ($game->getPlayers() as $player) {
                for ($i = 0; $i < $cards; $i++) {
                    $card = $deck->drawCard();
                    if ($card) {
                        $player->addCardToHand($card);
                    }
                }
            }
        }
        $data = [
            'deck' => $deck,
            'game' => $game,
            'valid' => $validGame,
            'suits' => $this->suits
        ];

        return $this->render('card/deal.html.twig', $data);
    }
}
