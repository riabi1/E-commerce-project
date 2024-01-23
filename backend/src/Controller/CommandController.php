<?php

namespace App\Controller;

use App\Service\CommandService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    #[Route('/commands', name:'command_list', methods: 'GET')]
    public function productList(CommandService $commandService): JsonResponse
    {
        return $commandService->CommandList();
    }

    #[Route('/command/create', name:'create_command', methods: 'POST')]
    public function createProduct(Request $request,CommandService $commandService): JsonResponse
    {
        return $commandService->createCommand($request->request->all());
    }

    #[Route('/command/update', name: 'update_command',methods:'POST')]
    public function updateProduct(CommandService $commandService): JsonResponse
    {
        return $commandService->updateCommand();
    }

    #[Route('/command/delete', name: 'delete_command',methods:'POST')]
    public function deleteProduct(CommandService $commandService): JsonResponse
    {
        return $commandService->deleteCommand();
    }
}
