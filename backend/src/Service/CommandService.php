<?php

namespace App\Service;

use App\Entity\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class CommandService
{
    private $entityManager;
    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    public function CommandList(): JsonResponse
    {
        $commands = $this->entityManager->getRepository(Command::class)->findAll();

        $commandsList = $this->serializer->serialize($commands,'json');

        return new JsonResponse($commandsList, JsonResponse::HTTP_OK, [], true);
    }
        public function createCommand(): JsonResponse
    {
        // $command = new Command();

        // $this->entityManager->persist($command);
        // $this->entityManager->flush();

        return new JsonResponse(['message' => 'Command created successfully'], JsonResponse::HTTP_CREATED);
    }


    public function updateCommand(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command updated successfully'], JsonResponse::HTTP_CREATED);
    }

    public function deleteCommand(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command deleted successfully'], JsonResponse::HTTP_CREATED);
    }
}
