<?php

namespace App\Controller;

use App\Service\FactureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FactureController extends AbstractController
{
    #[Route('/factures', name:'facture_list', methods: 'GET')]
    public function facturesList(FactureService $factureService): JsonResponse
    {
        return new JsonResponse($factureService->factureList());
    }
}
