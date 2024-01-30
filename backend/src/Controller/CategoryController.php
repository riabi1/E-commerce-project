<?php

namespace App\Controller;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'category_list',methods:'GET')]
    public function categoriesList(CategoryService $categoryService): JsonResponse
    {
        return $categoryService ->CategoryList();
    }
}