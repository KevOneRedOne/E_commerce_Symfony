<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcommerceController extends AbstractController
{
    #[Route('/ecommerce', name: 'app_ecommerce')]
    public function index(): Response
    {
        return $this->render('ecommerce/index.html.twig', [
            'controller_name' => 'EcommerceController',
        ]);
    }
    
}
