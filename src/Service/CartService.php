<?php

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $repo;
    private $rs;

    // injection de dépendances dans les contructeur
    public function __construct(ProductRepository $repo, RequestStack $rs)
        // la classe RequestStack permet de récuperer/créer une session
    {
        $this->repo =$repo;
        $this->rs =$rs;
    }

    public function add($id)
    {
        $session = $this->rs->getSession();
        // On récupère l'attribut de session 'cart' et s'il existe pas on récupère un tableau vide
        $cart=$session->get('cart', []);
        
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id]=1;
        }
        // Sauvergarde de l'etat du panier à l'attr de session 'cart'
        $session->set('cart', $cart);

        // dd($session->get('cart'));
        // dd(): Dump & Die = permet d'afficher des infos et de tuer l'exécution du code
    }

    public function remove($id)
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);

        // si l'ID existe dans le panier, je le supprime du tableau via le unset()
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        // Sauvegarde de l'etat du panier
        $session->set('cart', $cart);
    }

    public function removeItem($id)
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


    public function getCartWithData()
    {
        $session = $this->rs->getSession();
        $cart = $session->get('cart', []);
        // $qt contiendra le nombre total de produit dans le panier
        $qt=0;
        // on va créer un tableau qui contiendra des objects Product et les quantités
        $cartWithData = [];
        // $cartWithData est un tableau multidimensionnel : chaque case de ce tableau est un tableau associatif 
        // contenant 2 cases : une case 'product' et une case 'quantity'    
        foreach ($cart as $id => $quantity) 
        {
            $cartWithData[] = [
                'product' => $this->repo->find($id),
                'quantity' =>$quantity
            ];
            $qt+= $quantity;
        }
        // dd($cartWithData);
        $session-> set('qt', $qt);

        return $cartWithData;
    }

    public function getTotal()
    {
        $total= 0;
        // Pour chaque produit dans mon panier, je récupère le prix total par produit puis je l'ajoute au total Final
        foreach ($this->getCartWithData() as $item) 
        {
            $totalItem = $item['product']-> getPrice()*$item['quantity'];
            $total += $totalItem;    
        }
        return $total;
    }
}

