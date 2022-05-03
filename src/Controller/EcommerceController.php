<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EcommerceController extends AbstractController
{
    #[Route('/', name: 'app_ecommerce')]
    public function index(): Response
    {
        return $this->render('ecommerce/index.html.twig', [
            'controller_name' => 'EcommerceController',
        ]);
    }
    
    #[Route('/product', name: 'app_product')]
    public function product(ProductRepository $repo): Response
    {
        $produits = $repo->findAll();

        return $this->render('product/product.html.twig', [
            'produits' => $produits,
        ]);
    }
}
