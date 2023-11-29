<?php

namespace App\Controller\Api;

use App\Repository\UnityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/unities")
 */
class UnityController extends AbstractController
{
    /**
     * @Route("/", name="listUnity", methods="GET")
     */
    public function listUnity(UnityRepository $unityRepository) {

        return $this->json($unityRepository->findAll(), 200, [], ['groups' => 'unity_list']);
    }
}
