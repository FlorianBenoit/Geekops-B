<?php

namespace App\Controller\Api;

use App\Repository\WodRepetitionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/wods/repetitions")
 */
class WodRepetitionController extends AbstractController
{
    /**
     * @Route("/", name="wodRepetition", methods="GET")
     */
    public function wodRepetition(WodRepetitionRepository $wodRepetitionRepository) {

        return $this->json($wodRepetitionRepository->findAll(), 200, [], ['groups' => 'wod_rep_list']);
    }
}
