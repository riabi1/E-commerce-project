<?php

namespace App\Controller;

use App\Service\CustomersService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CustomersController extends AbstractController
{
    #[Route('/customers', name: 'list_customers')]
    public function customerList(CustomersService $customersService): JsonResponse
    {
        return $customersService->customerList();
    }

    #[Route('/customer/create', name: 'create_customer', methods: 'POST')]
    public function createCustomer(Request $request,CustomersService $customersService): JsonResponse
    {
        return $customersService->createCustomer($request->request->all());
    }

    #[Route('/customer/update', name: 'update_customer',methods:'POST')]
    public function updateProduct(Request $request, CustomersService $customersService): JsonResponse
    {
        return $customersService->updateCustomer($request->request->all());
    }

    #[Route('/customer/delete', name:'delete_customer', methods: 'POST')]
    public function deleteProduct(Request $request,CustomersService $customersService): JsonResponse
    {
        return $customersService->deleteCustomer($request->request->all());
    }
}
