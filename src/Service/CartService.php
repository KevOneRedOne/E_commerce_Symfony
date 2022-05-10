<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $repo;
    private $rs;

    public function __construct(ProductRepository $repo, RequestStack $rs)
    {
        $this->repo =$repo;
        $this->rs =$rs;
    }

    public function add($id)
    {
        $session = $this->rs->getSession();
        $cart=$session->get('cart', []);
        
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id]=1;
        }
        $session->set('cart', $cart);
    }

    public function addOne($id)
    {
        $session = $this->rs->getSession();
        $cart=$session->get('cart', []);
        
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id]=1;
        }
        $session->set('cart', $cart);
    }

    public function removeItem($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
    }

    public function removeOneItem($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id] = $cart[$id] - 1;
            } else {
                unset($cart[$id]);
            }
        }
        $session->set('cart', $cart);
    }

    public function removeAll()
    {
        $session= $this->rs->getSession();
        $cart = $session->get('cart', []);
        if (!empty($cart)) {
            unset($cart);
        }
        $session->set('cart', []);
    }


    public function getCartWithData()
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        $qt=0;
        $cartWithData = [];
        foreach ($cart as $id => $quantity) 
        {
            $cartWithData[] = [
                'product' => $this->repo->find($id),
                'quantity' =>$quantity
            ];
            $qt+= $quantity;
        }
        $session-> set('qt', $qt);

        return $cartWithData;
    }

    public function getTotal()
    {
        $total= 0;
        foreach ($this->getCartWithData() as $item) 
        {
            $totalItem = $item['product']-> getPrice()*$item['quantity'];
            $total += $totalItem;    
        }
        return $total;
    }

    
}

