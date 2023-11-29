<?php

namespace App\Controller\Api;

use App\Entity\Save;
use App\Entity\Wod;
use App\Repository\WodRepository;
use App\Repository\SaveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/saves", name="app_api_save")
 */
class SaveController extends AbstractController
{
   /**
     * @Route("/", name="list", methods="POST")
     */
    public function sendSave(EntityManagerInterface $em, Request $request, SerializerInterface $serializer, ValidatorInterface $validator, SaveRepository $saveRepository): JsonResponse
    {

        // récupérer les données au format json
        $json = $request->getContent();
        
        // deserialisation des données json pour obtenir un objet wod
        $save = $serializer->deserialize($json, Save::class, 'json');
        $save->setCreatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($save);
        if(count($errors) > 0){
            return $this->json($errors, 400);
        }

    
        // on persist et on flush
        $em->persist($save);
        $em->flush();
    
        // Récupérez le wod ID avant de supprimer le like
        $dataSaved = [
            'id' => $save->getId(),
            'note' => $save->getNote(),
            'time' => $save->getTime(),
            'laps' => $save->getLaps(),
            'wodId' => $save->getWod()->getId(),
            'createdAt' => $save->getCreatedAt()
        ];
        
        // // on renvoit une réponse
        // return $this->json([]);
        return $this->json($dataSaved, Response::HTTP_CREATED, [], ["groups" => 'save_create']);

    }
}
