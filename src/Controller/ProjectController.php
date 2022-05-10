<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="project")
     */
    public function project(ChartBuilderInterface $chartBuilder): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('project/index.html.twig', [
            'chart' => $chart
        ]);
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
