<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\TexasHoldemRepository;
use App\Entity\TexasHoldem as TexasEntity;
use Doctrine\Persistence\ManagerRegistry;
use App\Card\TexasHoldem;
use App\Card\Deck;
use App\Card\Player;
use App\Card\Bank;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="project", methods={"Get", "HEAD"})
     */
    public function projectIndex(
        ManagerRegistry $doctrine,
        SessionInterface $session
    ): Response {
        //$session->clear();
        if (!$session->has('texasHoldem')) {
            $texasHoldem = new TexasHoldem(new Player(), new Bank());
            $session->set('texasHoldem', $texasHoldem);
        }

        $entityManager = $doctrine->getManager();
        $player = $entityManager->getRepository(TexasEntity::class)->findAll();
        $oldRounds = $player[0]->getRounds();
        $oldWinnings = $player[0]->getWinnings();

        $texasHoldem = $session->get('texasHoldem');
        $deck = new Deck();
       // $texasHoldem->startGame($deck);

        $data = [
            'player' => $texasHoldem->getPlayer()->getHand(),
            'dealer' => $texasHoldem->getDealer()->getHand(),
            'table' => $texasHoldem->getTable(),
            'deck' => $deck,
            'showButton' => $texasHoldem->startNewGame,
            'rounds' => $oldRounds,
            'winnings' => $oldWinnings,
        ];

        return $this->render('project/index.html.twig', $data);
    }
    /**
     * @Route("/proj/reset", name="project_reset", methods={"Get", "HEAD"})
     */
    public function projectReset(ManagerRegistry $doctrine): Response
    {
        $connection = $doctrine->getConnection();
        $sql = "DELETE from texas_holdem";
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $entityManager = $doctrine->getManager();
        $player = new TexasEntity();
        $player->setRounds(0);
        $player->setWinnings(100);

        $entityManager->persist($player);

        $entityManager->flush();

        return $this->redirectToRoute('project');
    }

    /**
     * @Route("/proj", name="project_post", methods={"POST"})
     */
    public function projectIndexPost(
        ManagerRegistry $doctrine,
        SessionInterface $session,
        Request $request
    ): Response {

        $entityManager = $doctrine->getManager();
        $player = $entityManager->getRepository(TexasEntity::class)->findAll();
        $oldRounds = $player[0]->getRounds();
        $oldWinnings = $player[0]->getWinnings();


        $texasHoldem = $session->get("texasHoldem");
        $newGame = $request->request->get('newGame');
        $call = $request->request->get('call');
        $fold = $request->request->get('fold');

        if ($newGame) {
            $player[0]->setRounds($oldRounds + 1);
            $texasHoldem->startGame(new Deck());
        }
        if ($call) {
            $player[0]->setWinnings($oldWinnings - 30);
            $texasHoldem->call();
            if ($texasHoldem->isPlayerWinner()) {
                $player[0]->setWinnings($oldWinnings + 30);
            }
        }
        if ($fold) {
            $player[0]->setWinnings($oldWinnings - 10);
            $texasHoldem->fold();
        }

        $entityManager->flush();
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
