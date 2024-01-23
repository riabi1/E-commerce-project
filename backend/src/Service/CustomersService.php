<?php

namespace App\Service;

use App\Entity\Customers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CustomersService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function createCustomer(): JsonResponse
    {
        $customers = $this->entityManager->getRepository(Customers::class)->findAll();

        // $customers
        return new JsonResponse(['message' => 'Customer created successfully'], JsonResponse::HTTP_CREATED);
    }

    public function CustomerList(): JsonResponse
    {
        return new JsonResponse(['message' => 'Customer list'], JsonResponse::HTTP_CREATED);
    }

    public function updateCustomer(): JsonResponse
    {
        return new JsonResponse(['message' => 'Customer updated successfully'], JsonResponse::HTTP_CREATED);
    }

    public function deleteCustomer(): JsonResponse
    {
        return new JsonResponse(['message' => 'Customer deleted successfully'], JsonResponse::HTTP_CREATED);
    }
}
