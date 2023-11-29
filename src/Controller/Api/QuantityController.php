<?php

namespace App\Controller\Api;

use App\Repository\QuantityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/quantities")
 */
class QuantityController extends AbstractController
{
    /**
     * @Route("/", name="listQuantity", methods="GET")
     */
    public function listQuantity(QuantityRepository $quantityRepository) {

        return $this->json($quantityRepository->findAll(), 200, [], ['groups' => 'quantities_list']);
    }
}
