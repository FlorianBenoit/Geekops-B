<?php

namespace App\Controller\Api;

use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/comments")
 */
class CommentController extends AbstractController
{
    /**
    * @Route("/{id}", name="update_comment", methods={"PUT"})
    */
    public function updateComment($id, EntityManagerInterface $em, Request $request, SerializerInterface $serializer, CommentRepository $commentRepository, ValidatorInterface $validator, Security $security): JsonResponse
    {
        // Utilisation du CommentRepository pour récupérer le commentaire
        $comment = $commentRepository->find($id);

        if ($comment === null) {
            $errorMessage = [
                'message' => "Comment not found",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }

        // Vérifier si l'utilisateur actuel est l'auteur du commentaire
        if ($comment->getUser() !== $security->getUser()) {
            $errorMessage = [
                'message' => "Tu n est pas l auteur du commentaire.",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_FORBIDDEN);
        }

        // On veut directement traiter les données reçues en JSON
        $json = $request->getContent();

        $serializer->deserialize($json, Comment::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $comment]);

        $errorList = $validator->validate($comment);
        if (count($errorList) > 0) {
            return $this->json($errorList, Response::HTTP_BAD_REQUEST);
        }

        $em->flush();

        return $this->json($comment, Response::HTTP_OK, [], ["groups" => 'comments_update']);
    }
}