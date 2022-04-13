<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
