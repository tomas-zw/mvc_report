<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Card\TexasHoldem;
use App\Card\Deck;
use App\Card\Player;
use App\Card\Bank;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="project", methods={"Get", "HEAD"})
     */
    public function projectIndex(SessionInterface $session): Response
    {
        //$session->clear();
        if (!$session->has('texasHoldem')) {
            $texasHoldem = new TexasHoldem(new Player(), new Bank());
            $session->set('texasHoldem', $texasHoldem);
        }

        $texasHoldem = $session->get('texasHoldem');
        $deck = new Deck();
       // $texasHoldem->startGame($deck);

        $data = [
            'player' => $texasHoldem->getPlayer()->getHand(),
            'dealer' => $texasHoldem->getDealer()->getHand(),
            'table' => $texasHoldem->getTable(),
            'deck' => $deck,
            'showButton' => $texasHoldem->startNewGame,
        ];

        return $this->render('project/index.html.twig', $data);
    }

    /**
     * @Route("/proj", name="project_post", methods={"POST"})
     */
    public function projectIndexPost(
        SessionInterface $session,
        Request $request): Response
    {
        $texasHoldem = $session->get("texasHoldem");
        $newGame = $request->request->get('newGame');
        $call = $request->request->get('call');
        $fold = $request->request->get('fold');

        if ($newGame) {
            $texasHoldem->startGame(new Deck());
        }
        if ($call) {
            $texasHoldem->call();
        }
        if ($fold) {
            $texasHoldem->fold();
        }

        $session->set('texasHoldem', $texasHoldem);

        return $this->redirectToRoute('project');

    }

    /**
     * @Route("/proj/about", name="project-about")
     */
    public function projectAbout(): Response
    {
        return $this->render('project/about.html.twig');
    }

    /**
     * @Route("/proj/cleancode", name="project-cleancode")
     */
    public function projectCleanCode(): Response
    {
        return $this->render('project/cleancode.html.twig');
    }
}
