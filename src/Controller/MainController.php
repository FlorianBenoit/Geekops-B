<?php

namespace App\Controller;

use App\Entity\ExerciceRepetition;
use App\Repository\ExerciceRepository;
use App\Repository\WodRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/back", name="home")
     */

    public function index(WodRepository $wodRepository, ExerciceRepository $ExerciceRepository): Response
    {

        $wods = $wodRepository->findAll();
        $exercice = $ExerciceRepository->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'wods' => $wods,
            'exercice' => $exercice,
        ]);
    }
}
