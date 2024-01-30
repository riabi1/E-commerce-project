<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;



class ProductService
{
    private $entityManager;
    private $serializer;

    public function __construct(SerializerInterface $serializer, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }
    public function productList(): JsonResponse
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $productsList = $this->serializer->serialize($products, 'json', ['groups' => 'prod']);

        return new JsonResponse($productsList, JsonResponse::HTTP_OK, [], true);
    }

    public function createProduct($request): JsonResponse
    {
        $product = new Product();
        $product->setProductName($request['product_name']);
        $product->setPrice($request['price']);
        $product->setStockQuantity($request['stock_quantity']);
        $product->setDescription($request['description']);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Product created successfully'], JsonResponse::HTTP_CREATED);
    }



    public function updateProduct($request): JsonResponse
    {
        $product = $this->entityManager->getRepository(Product::class)->find($request["id"]);

        if (!$product) {
            return new JsonResponse(['message' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $product->setProductName($request['product_name']);
        $product->setPrice($request['price']);
        $product->setStockQuantity($request['stock_quantity']);
        $product->setDescription($request['description']);

        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Product updated successfully'], JsonResponse::HTTP_OK);
    }


    public function deleteProduct($request): JsonResponse
    {
        $product = $this->entityManager->getRepository(Product::class)->find($request);

        if (!$product) {
            return new JsonResponse(['message' => 'Product not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($product);
        $this->entityManager->flush();

        return new JsonResponse(['message' => 'Product deleted successfully'], JsonResponse::HTTP_OK);
    }
}
