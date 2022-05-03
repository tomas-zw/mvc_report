<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class metricsController extends AbstractController
{
    /**
     * @Route("/metrics", name="metrics")
     */
    public function metrics(): Response
    {
        return $this->render('metrics.html.twig');
    }
}
