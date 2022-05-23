<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\TexasHoldem;
use App\Card\Deck;
use App\Card\Player;
use App\Card\Bank;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="project")
     */
    public function projectIndex(): Response
    {
        $deck = new Deck();
        $deck->shuffleDeck();
        $player = new Player();
        $bank = new Bank();
        $texasHoldem = new TexasHoldem($player, $bank, $deck);
        $texasHoldem->startGame();
        $data = [
            'player' => $texasHoldem->getPlayer()->getHand(),
            'dealer' => $texasHoldem->getDealer()->getHand(),
            'table' => $texasHoldem->getTable(),
            'deck' => $deck,
        ];

        return $this->render('project/index.html.twig', $data);
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
