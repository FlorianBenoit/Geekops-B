<?php

namespace App\Controller\Api;

use App\Repository\ExerciceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/exercices")
 */
class ExerciceController extends AbstractController
{
    /**
     * @Route("/", name="listExercices", methods="GET")
     */
    public function listExercices(ExerciceRepository $exerciceRepository) {

        return $this->json($exerciceRepository->findAll(), 200, [], ['groups' => 'exercices_list']);
    }
}

