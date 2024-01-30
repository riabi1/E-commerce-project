<?php

namespace App\Service;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class CategoryService
{
    private $entityManager;
    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    public function CategoryList(): JsonResponse
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAll();

        $categoriesList = $this->serializer->serialize($categories,'json',['groups' => 'prod']);

        return new JsonResponse($categoriesList, JsonResponse::HTTP_OK, [], true);
    }
}
