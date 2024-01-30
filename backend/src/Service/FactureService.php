<?php

namespace App\Service;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class FactureService
{
    private $entityManager;
    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    
    public function factureList():JsonResponse
    {
        $facture = $this->entityManager->getRepository(Facture::class)->findAll();
        $factureList = $this->serializer->serialize($facture, 'json');
        return new JsonResponse($factureList, JsonResponse::HTTP_OK, [], true);
    }
}
