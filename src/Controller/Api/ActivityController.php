<?php

namespace App\Controller\Api;

use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/activities")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="activityList", methods="GET")
     */
    public function activityList(ActivityRepository $activityRepository) {

        return $this->json($activityRepository->findAll(), 200, [], ['groups' => 'activity_list']);
    }
}
