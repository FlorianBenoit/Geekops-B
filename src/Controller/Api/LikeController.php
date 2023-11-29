<?php

namespace App\Controller\Api;

use App\Entity\Like;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/likes")
 */
class LikeController extends AbstractController
{ /**
    * @Route("/", name="listlikes", methods="GET")
    */
   public function listLikes(LikeRepository $LikeRepository): JsonResponse
   {
       return $this->json($LikeRepository->findAll(), 200, [], ['groups' => 'list_likes']);
   }

    /**
     * @Route("/", name="createlikes", methods="POST")
     */
    public function createlikes(EntityManagerInterface $em, Request $request, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {

        // récupérer les données au format json
        $json = $request->getContent();
        
        // deserialisation des données json pour obtenir un objet like
        $like = $serializer->deserialize($json, Like::class, 'json');

        $errors = $validator->validate($like);
        if(count($errors) > 0){
            return $this->json($errors, 400);
        }
        // on persist et on flush
        $em->persist($like);
        $em->flush();
    
        // return $this->json([]);
        return $this->json($like, Response::HTTP_CREATED, [], ["groups" => 'create_likes']);

    }

    /**
     * @Route("/{userId}/{wodId}", name="deleteLike", methods="DELETE")
     */
    public function deleteLike($userId, $wodId, EntityManagerInterface $em): JsonResponse
    {
        // Recherchez le like en fonction de l'ID du wod et de l'ID de l'utilisateur
        $like = $em->getRepository(Like::class)->findOneBy(['wod' => $wodId, 'user' => $userId]);

        if ($like === null) {
            $errorMessage = [
                'message' => "Like Introuvable",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }

        // Récupérez le wod ID avant de supprimer le like
        $wodIdToDelete = $like->getWod()->getId();

        // Supprimez le like et effectuez un flush pour enregistrer les modifications
        $em->remove($like);
        $em->flush();

        // Réponse JSON avec le wod ID supprimé
        return $this->json(["wodId" => $wodIdToDelete ]);

    }
}