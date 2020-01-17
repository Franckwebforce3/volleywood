<?php

namespace App\Service\Cart;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {
    protected $session;
    protected $produitRepository;

    public function __construct(SessionInterface $session, ProduitRepository $produitRepository)
    {
        $this->session              = $session;
        $this->produitRepository    = $produitRepository;
    }

    public function add($id) 
    {
        $panier = $this->session->get('panier', []);

        if( !empty($panier[$id]) ) {
            $panier[$id]++;
        }
        else {
            $panier[$id]    = 1;
        }
        
        $this->session->set('panier', $panier);
    }

    public function remove($id) 
    {
        $panier = $this->session->get('panier', []);

        if( !empty($panier[$id]) ) {
            unset($panier[$id]);
        }

        $this->session->set('panier', $panier);
    }

    public function getFullCart() : array {
        $panier = $this->session->get('panier', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'produit'  => $this->produitRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;
    }

    public function getTotalCart() : float {
        $total = 0;

        foreach($this->getFullCart() as $item) {
            $total += $item['produit']->getPrixVente() * $item['quantity'];
        }      
        
        return $total;
    }
}