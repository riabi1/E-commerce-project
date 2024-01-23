<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function productList(): JsonResponse
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $productsList = [];

        foreach ($products as $product) {
            $productsList[] = [
                'id' => $product->getId(),
                'name' => $product->getProductName(),
                'price' => $product->getPrice(),
                'stock_quantity' => $product->getStockQuantity(),
                'description' => $product->getDescription(),
                'category' => $product->getCategory(),
            ];
        }

        return new JsonResponse($productsList, JsonResponse::HTTP_OK);
    }
    public function createProduct($request): JsonResponse
    {
        $product = new Product();
        $product->setProductName($request['product_name']);
        $product->setPrice($request['price']);
        $product->setStockQuantity($request['stock_quantity']);
        $product->setDescription($request['description']);
        $product->setCategory($request['category']);

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
        $product->setCategory($request['category']);

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
