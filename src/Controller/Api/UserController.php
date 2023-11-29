<?php

namespace App\Controller\Api;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Repository\UserRepository;
use App\DTO\UserWithLikesAndWodDTO;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;


/**
 * @Route("/api/users")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/{id}", name="readUser", methods="GET", requirements={"id"="\d+"})
     */
    public function readUser($id, UserRepository $userRepository): JsonResponse
    {
        $user = $userRepository->findUserWithLikesAndWodAndSaves($id);
    
        if ($user === null) {
            $errorMessage = [
                'message' => "user not found",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }
    
        // Créez un DTO personnalisé pour la réponse
        $userDTO = new UserWithLikesAndWodDTO(
            $user->getId(),
            $user->getUsername(),
            $user->getMail(),
            $user->getLikes()->map(function($like) {
                return $like->getWod()->getId();
            })->toArray(),
            $user->getSaves()->map(function($save) {
                return [
                    'id' => $save->getId(),
                    'note' => $save->getNote(),
                    'time' => $save->getTime(),
                    'laps' => $save->getLaps(),
                    'wodId' => $save->getWod()->getId(),
                    'createdAt' => $save->getCreatedAt()
                ];
            })->toArray(),
            $user->getWods()->map(function($createdWods) {
                return $createdWods->getId();
            })->toArray()
        );
    
        return $this->json($userDTO, Response::HTTP_OK, [], ["groups" => "user_read"]);
    }

    /**
    * @Route("/", name="createUser", methods="POST")
    */
    public function createUser(EntityManagerInterface $em, JWTTokenManagerInterface $jwtManager, Request $request, SerializerInterface $serializer, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher, ValidatorInterface $validator): JsonResponse
    {

        // récupérer les données au format json
        $json = $request->getContent();

        // deserialisation des données json pour obtenir un objet user
        $user = $serializer->deserialize($json, User::class, 'json');

        // Vérifier si un compte existe déjà pour l'adresse e-mail ou le pseudo
        $existingUserByEmail = $userRepository->findOneBy(['mail' => $user->getMail()]);
        $existingUserByUsername = $userRepository->findOneBy(['username' => $user->getUsername()]);


        if ($existingUserByEmail || $existingUserByUsername) {
            // Un compte existe déjà avec cette adresse e-mail ou ce pseudo
            $errorMessage = [
                'message' => 'Un compte est deja associe a cette adresse e-mail ou ce pseudo.',
            ];
            return new JsonResponse($errorMessage, Response::HTTP_CONFLICT);
        }

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
        
            return new JsonResponse(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        // Hasher le mot de passe
        $clearPassword = $user->getPassword();
        $hashedPassword = $passwordHasher->hashPassword($user, $clearPassword);
        $user->setPassword($hashedPassword);

        // on persist et on flush
        $em->persist($user);
        $em->flush();

        $token = $jwtManager->create($user);
        // on renvoit une réponse
        return new JsonResponse(['token' => $token], Response::HTTP_CREATED);


    }

    /**
     * @Route("/{id}", name="update", methods="PUT", requirements={"id"="\d+"})
     */
    public function update($id, EntityManagerInterface $em, Request $request, SerializerInterface $serializer, UserRepository $userRepository, ValidatorInterface $validator): JsonResponse
    {
        $user = $em->find(User::class, $id);

        if ($user === null) {
            $errorMessage = [
                'message' => "Utilisateur non trouve",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }

        // On veut directement traiter les données reçues en JSON
        $json = $request->getContent();

        $serializer->deserialize($json, User::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $user]);

        // Vérifier si un autre compte existe déjà avec cette adresse e-mail ou nom d'utilisateur
        $existingUserMail = $userRepository->findOneBy(['mail' => $user->getmail()]);
        $existingUserName = $userRepository->findOneBy(['username' => $user->getUsername()]);

        if (($existingUserMail && $existingUserMail->getId() !== $user->getId()) || ($existingUserName && $existingUserName->getId() !== $user->getId())) {
            // Un autre compte existe déjà avec cette adresse e-mail ou ce nom d'utilisateur
            $errorMessage = [
                'message' => 'Un compte est deja associe a cette adresse e-mail ou ce pseudo.',
            ];
            return new JsonResponse($errorMessage, Response::HTTP_BAD_REQUEST);
        }

        $errorList = $validator->validate($user);
        if (count($errorList) > 0) {
            return $this->json($errorList, Response::HTTP_BAD_REQUEST);
        }

        // Pas besoin de persister car on a fait un find
        // $em->persist($user);
        $em->flush();

        // On renvoie une réponse
        return $this->json($user, Response::HTTP_OK, [], ["groups" => 'users_update']);
    }

}