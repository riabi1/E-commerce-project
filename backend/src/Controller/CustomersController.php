<?php

namespace App\Controller;

use App\Service\CustomersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CustomersController extends AbstractController
{
    #[Route('/customers', name: 'list_customers')]
    public function productList(CustomersService $customersService): JsonResponse
    {
        return $customersService->CustomerList();
    }

    #[Route('/customer/create', name: 'create_customer')]
    public function createCustomer(CustomersService $customersService): JsonResponse
    {
        return $customersService->createCustomer();
    }

    #[Route('/customer/update', name: 'update_customer')]
    public function updateProduct(CustomersService $customersService): JsonResponse
    {
        return $customersService->updateCustomer();
    }

    #[Route('/customer/delete', name: 'delete_customer')]
    public function deleteProduct(CustomersService $customersService): JsonResponse
    {
        return $customersService->deleteCustomer();
    }
}
