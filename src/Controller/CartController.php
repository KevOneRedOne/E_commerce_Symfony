<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cs): Response
    {
        return $this->render('cart/cart.html.twig', [
            'items' => $cs -> getCartWithData(),
            'total' => $cs -> getTotal()
        ]);
    }
    #[Route('/cart/add/{id}', name:"cart_add")]
    public function add($id, CartService $cs)
    {
        $cs->add($id);
        return $this->redirectToRoute('app_cart');

    }

    #[Route("/cart/removeItem/{id}", name:"cart_removeItem")]
    public function remove($id, CartService $cs)
    {
        $cs->removeItem($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route("/cart/removeOneItem/{id}", name:"cart_removeOneItem")]
    public function removeItem($id, CartService $cs)
    {
        $cs->removeOneItem($id);
        return $this->redirectToRoute('app_cart');
    }

    #[Route("/cart/removeAll/", name:"cart_removeAll")]
    public function removeAll(CartService $cs)
    {
        $cs->removeAll();
        return $this->redirectToRoute('app_cart');
    }

}
