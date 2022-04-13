<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Card\BlackJack;
use App\Card\Player;
use App\Card\Bank;
use App\Card\Deck;

class GameController extends AbstractController
{
    /** @var array<string, string> */
    private $suits = [
        'hearts' => '♥',
        'diamonds' => '♦',
        'clubs' => '♣',
        'spades' => '♠',
        'blank' => '✱',
        'joker' => '🃏',
    ];
    /**
     * @Route("/game", name="game_info")
     */
    public function game(): Response
    {
        return $this->render('game/info.html.twig');
    }

    /**
     * @Route("/game/doc", name="game_report")
     */
    public function gameReport(): Response
    {
        return $this->render('game/doc.html.twig');
    }

    /**
     * @Route("/game/game", name="game_game")
     */
    public function gameBlackJack(SessionInterface $session): Response
    {
        if (!$session->has('blackJack')) {
            $startGame = new BlackJack(new Player(), new Bank());
            $session->set('blackJack', $startGame);
        }

        $blackJack = $session->get('blackJack');
        $blackJack->newGame(new Deck());
        $data = [
            'player' => $blackJack->getPlayer(),
            'bank' => $blackJack->getBank(),
            'currentPlayer' => $blackJack->getCurrentPlayer(),
            'msg' => $blackJack->getMsg(),
            'suits' => $this->suits
        ];

        return $this->render('game/blackJack.html.twig', $data);
    }
}
