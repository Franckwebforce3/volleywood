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
        $idtemp = intval($id);
        dump($id);
        $panier = $this->session->get('panier', []);

        if( !empty($panier[$idtemp]) ) {
            $panier[$idtemp]++;
        }
        else {
            $panier[$idtemp] = 1;
        }
        
        $this->session->set('panier', $panier);
    }

    public function tailleChange($id,  $taille) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        $panierTaille[$id]= $taille;
        
        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function increment($id) 
    {
        $panier = $this->session->get('panier', []);

        $panier[$id]++;
        
        $this->session->set('panier', $panier);
    }

    public function remove($id) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);
  
        $panier[$id]--;

        if( $panier[$id] == 0 ) {
            unset($panier[$id]);
            unset($panierTaille[$id]);
        }

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function delete($id) 
    {
        $panier = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        if( !empty($panier[$id]) ) {
            unset($panier[$id]);
            unset($panierTaille[$id]);
        }

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function getFullCart() : array {
        $panier = $this->session->get('panier', []);
        $panierTaille = $this->session->get('taille', []);

        $panierWithData = [];

        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'produit'  => $this->produitRepository->find($id),
                'quantity' => $quantity,
                'taille'   => $panierTaille[$id] ?? "",
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

    public function getTotalItemCart() : int {
        $panier = $this->session->get('panier', []);
        return count($panier);
    }
}