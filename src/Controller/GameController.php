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
    * @Route(
    *   "/game/game",
    *   name="game_game",
    *   methods={"Get", "HEAD"}
    * )
     */
    public function gameBlackJack(SessionInterface $session): Response
    {
        // $session->clear();
        if (!$session->has('blackJack')) {
            $startGame = new BlackJack(new Player(), new Bank());
            $session->set('blackJack', $startGame);
        }

        $blackJack = $session->get('blackJack');

        $blackJack->playGame(new Deck());

        $session->set('blackJack', $blackJack);

        $data = [
            'player' => $blackJack->getPlayer(),
            'bank' => $blackJack->getBank(),
            'currentPlayer' => $blackJack->getCurrentPlayer(),
            'msg' => $blackJack->getMsg(),
            'suits' => $blackJack->getSuits()
        ];

        return $this->render('game/blackJack.html.twig', $data);
    }

    /**
    * @Route(
    *   "game/game",
    *   name="game_game_post",
    *   methods={"POST"})
     */
    public function gameBlackJackPost(
        SessionInterface $session,
        Request $request
    ): Response {
        $blackJack = $session->get("blackJack");
        $newCard = $request->request->get('newCard');
        $noCard = $request->request->get('noCard');
        $newGame = $request->request->get('newGame');

        if ($newGame) {
            $blackJack->setStartNewGame(true);
        }
        if ($newCard) {
            $blackJack->setDrawNewCard(true);
        }
        if ($noCard) {
            $blackJack->noMoreCards();
        }

        $session->set('blackJack', $blackJack);

        return $this->redirectToRoute('game_game');
    }
}
