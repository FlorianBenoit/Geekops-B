<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/categories")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="categoryList", methods="GET")
     */
    public function categoryList(CategoryRepository $categoryRepository) {

        return $this->json($categoryRepository->findAll(), 200, [], ['groups' => 'category_list']);
    }
}

