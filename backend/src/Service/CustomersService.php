<?php

namespace App\Service;

use App\Entity\Customers;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class CustomersService
{
    private $entityManager;
    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    public function customerList(): JsonResponse
    {
        $customers = $this->entityManager->getRepository(Customers::class)->findAll();

        $customersList = $this->serializer->serialize($customers, 'json');

        return new JsonResponse($customersList, JsonResponse::HTTP_OK, [], true);
    }
    public function createCustomer($request): JsonResponse
    {
        $customers = new Customers();
        $customers->setFirstName($request['first_name']);
        $customers->setLastName($request['last_name']);
        $customers->setEmail($request['email']);
        $customers->setPhoneNumber($request['phone_number']);
        $customers->setAddress($request['address']);

        $this->entityManager->persist($customers);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Customer created successfully'], JsonResponse::HTTP_CREATED);
    }


    public function updateCustomer($request): JsonResponse
    {
        $customers = $this->entityManager->getRepository(Customers::class)->find($request["id"]);

        if (!$customers) {
            return new JsonResponse(['messsage' => 'Customer not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $customers->setFirstName($request['first_name'] ?? $customers->getFirstName());
        $customers->setLastName($request['last_name'] ?? $customers->getLastName());
        $customers->setEmail($request['email'] ?? $customers->getEmail());
        $customers->setPhoneNumber($request['phone_number'] ?? $customers->getPhoneNumber());
        $customers->setAddress($request['address'] ?? $customers->getAddress());

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Customer updated successfully'], JsonResponse::HTTP_CREATED);
    }

    public function deleteCustomer($request): JsonResponse
    {
        $customers = $this->entityManager->getRepository(Customers::class)->find($request["id"]);

        if (!$customers) {
            return new JsonResponse(['messsage' => 'Customer not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($customers);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Customer deleted successfully'], JsonResponse::HTTP_CREATED);
    }
}
