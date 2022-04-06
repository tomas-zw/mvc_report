<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardControllerTwig extends AbstractController
{
    /**
    * @Route(
*        "/card",
*        name="card_home")
     */
    public function card(): Response
    {

        return $this->render('card.html.twig');
    }
}
