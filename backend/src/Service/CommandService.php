<?php

namespace App\Service;

use App\Entity\Command;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommandService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function CommandList(): JsonResponse
    {
        $commands = $this->entityManager->getRepository(Command::class)->findAll();

        $commandsList = [];

        foreach($commands as $command)
        {
            $commandsList[]=[
                'id'=>$command->getId(),
                'order_date'=>$command->getOrderDate(),
                'total_amount'=>$command->getTotalAmount(),
                'status'=>$command->getStatus(),
                'shipping_address'=>$command->getShippingAddress(),
                'payment_method	'=>$command->getPaymentMethod()
            ];
        }

        return new JsonResponse($commandsList, JsonResponse::HTTP_OK);
    }
    public function createCommand($request): JsonResponse
    {
        $command = new Command();

        $this->entityManager->persist($command);
        $this->entityManager->flush();

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
