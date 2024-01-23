<?php

namespace App\Controller;

use App\Service\CommandService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    #[Route('/command', name: 'app_command')]
    #[Route('/products', name: 'product_list')]
    public function productList(CommandService $commandService): JsonResponse
    {
        return $commandService->CommandList();
    }

    #[Route('/product/create', name: 'create_product')]
    public function createProduct(CommandService $commandService): JsonResponse
    {
        return $commandService->createCommand();
    }

    #[Route('/product/update', name: 'update_product')]
    public function updateProduct(CommandService $commandService): JsonResponse
    {
        return $commandService->updateCommand();
    }

    #[Route('/product/delete', name: 'delete_product')]
    public function deleteProduct(CommandService $commandService): JsonResponse
    {
        return $commandService->deleteCommand();
    }
}
