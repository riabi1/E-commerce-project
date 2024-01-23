<?php

namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'product_list', methods: 'GET')]
    public function productList(ProductService $productService): JsonResponse
    {
        return $productService->productList();
    }

    #[Route('/product/create', name: 'create_product', methods: 'POST')]
    public function createProduct(Request $request, ProductService $productService): JsonResponse
    {
        return $productService->createProduct($request->request->all());
    }

    #[Route('/product/update', name: 'update_product', methods: 'POST')]
    public function updateProduct(Request $request, ProductService $productService): JsonResponse
    {
        return $productService->updateProduct($request->request->all());
    }

    #[Route('/product/delete', name: 'delete_product', methods: 'POST')]
    public function deleteProduct(Request $request, ProductService $productService): JsonResponse
    {
        return $productService->deleteProduct($request->request->all());
    }
}
