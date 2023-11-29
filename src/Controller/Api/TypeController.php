<?php

namespace App\Controller\Api;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/types")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="typeList", methods="GET")
     */
    public function typeList(TypeRepository $typeRepository) {

        return $this->json($typeRepository->findAll(), 200, [], ['groups' => 'type_list']);
    }
}
