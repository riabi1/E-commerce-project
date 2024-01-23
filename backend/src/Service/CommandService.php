<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class CommandService
{
    public function createCommand(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command created successfully'], JsonResponse::HTTP_CREATED);
    }

    public function CommandList(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command list'], JsonResponse::HTTP_CREATED);
    }

    public function updateCommand(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command updated successfully'], JsonResponse::HTTP_CREATED);
    }

    public function deleteCommand(): JsonResponse
    {
        return new JsonResponse(['message' => 'Command deleted successfully'], JsonResponse::HTTP_CREATED);
    }
}
