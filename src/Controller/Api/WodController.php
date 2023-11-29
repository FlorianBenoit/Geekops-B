<?php

namespace App\Controller\Api;

use App\Entity\Wod;
use App\Repository\WodRepository;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api/wods")
 */
class WodController extends AbstractController
{
    /**
     * @Route("/", name="list", methods="GET")
     */
    public function list(WodRepository $wodRepository): JsonResponse
    {
        return $this->json($wodRepository->findAll(), 200, [], ['groups' => 'wod_list']);
    }

    /**
     * @Route("/{id}", name="read", methods="GET", requirements={"id"="\d+"})
     */
    public function read($id, WodRepository $wodRepository): JsonResponse
    {
        // comme le param converte
        $wod = $wodRepository->find($id);

        if ($wod === null)
        {
            $errorMessage = [
                'message' => "wod not found",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'wod' => $wod,
        ], Response::HTTP_OK, [], ["groups" => "wod_read"]);
        
    }


  /**
 * @Route("/", name="create", methods="POST")
 */
public function create( EntityManagerInterface $em, Request $request, SerializerInterface $serializer, ValidatorInterface $validator, WodRepository $wodRepository): JsonResponse {
    // Get the JSON data from the request
    $json = $request->getContent();
dump($json);
    // Deserialize the JSON data into a Wod object
    $wod = $serializer->deserialize($json, Wod::class, 'json');
    $wod->setCreatedAt(new \DateTime())
        ->setStatus(0)
        ->setImage(self::getRandomLoremPicsumImageURL());
        
    // Validate the Wod entity
    $errors = $validator->validate($wod);
    if (count($errors) > 0) {
        return $this->json($errors, Response::HTTP_BAD_REQUEST);
    }

    $existingWod = $wodRepository->findOneBy(['name' => $wod->getName()]);
    if ($existingWod) {
        $errorMessage = ['message' => 'A Wod with this name already exists.'];
        return new JsonResponse($errorMessage, Response::HTTP_BAD_REQUEST);
    }

    // Persist and flush the entities
    $em->persist($wod);
    $em->flush();

    // Return the created Wod entity
    return $this->json($wod, Response::HTTP_CREATED, [], ['groups' => 'wod_create']);
}

    /**
     * @Route("/{id}", name="delete", methods="DELETE")
     */
    public function delete($id, EntityManagerInterface $em): JsonResponse
    {

        // récupére l'entité depuis la BDD
        $wod = $em->find(wod::class, $id);

        if ($wod === null)
        {
            $errorMessage = [
                'message' => "wod not found",
            ];
            return new JsonResponse($errorMessage, Response::HTTP_NOT_FOUND);
        }

        // lancer $em->remove($monEntite)
        $em->remove($wod);

        // + flush pour exécuter les requêtes
        $em->flush();

        return $this->json("Done");
    }

    public static function getRandomLoremPicsumImageURL($width = 600, $height = 500)
    {
        $baseUrl = 'https://picsum.photos/';
        https://picsum.photos/200/300?grayscale
        $randomImage = rand(1, 1000);
        $imageUrl = "{$baseUrl}/seed/{$randomImage}{$width}/{$height}";


        return $imageUrl;
    }

}
