<?php

namespace App\Controller;

use App\Entity\Wod;
use App\Form\WodType;
use App\Repository\WodRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/back/wods")
 */
class WodController extends AbstractController
{
    /**
     * @Route("/", name="app_wod_index", methods={"GET"})
     */
    public function index(WodRepository $wodRepository): Response
    {
        return $this->render('wod/index.html.twig', [
            'wods' => $wodRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/new", name="app_wod_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WodRepository $wodRepository): Response
    {
        $wod = new Wod();
        $form = $this->createForm(WodType::class, $wod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wodRepository->add($wod, true);

            return $this->redirectToRoute('app_wod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wod/new.html.twig', [
            'wod' => $wod,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_wod_show", methods={"GET"})
     */
    public function show(Wod $wod): Response
    {
        return $this->render('wod/show.html.twig', [
            'wod' => $wod,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_wod_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Wod $wod, WodRepository $wodRepository): Response
    {
        $form = $this->createForm(WodType::class, $wod);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wodRepository->add($wod, true);

            return $this->redirectToRoute('app_wod_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wod/edit.html.twig', [
            'wod' => $wod,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_wod_delete", methods={"POST"})
     */
    public function delete(Request $request, Wod $wod, WodRepository $wodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wod->getId(), $request->request->get('_token'))) {
            $wodRepository->remove($wod, true);
        }

        return $this->redirectToRoute('app_wod_index', [], Response::HTTP_SEE_OTHER);
    }
    
    /** 
    * @Route("/back/wods/{id}/toggle-status", name="toggle_wod_status", methods={"POST"})
    */
    public function toggleStatus(Wod $wod, WodRepository $wodRepository): JsonResponse
   {
      // Inverser le statut (activer/désactiver)
      $wod->setStatus(!$wod->isStatus());
      $wodRepository->add($wod, true);

      return $this->json(['success' => true]);
   }

}


   
   



