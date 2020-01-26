<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\ProduitRepository;

use App\Service\Cart\CartService;

/**
 * @Route("/boutique")
 */
class BoutiqueController extends AbstractController
{
    /**
     * @Route("/nosProduits", name="nosProduits")
     */
    public function nosProduits(ProduitRepository $ProduitRepository, CartService $cartService)
    {
        // READ SUR LES Produits
        // ET ENSUITE ON TRANSLET A TWIG POUR L'AFFICHAGE :
        // $produits = $ProduitRepository->findByAllProducts();
        $produits = $ProduitRepository->findBy([], [ 
            "categorie" => "ASC",
            "titre"     => "ASC",
        ]);

        return $this->render('boutique/nosProduits.html.twig', [
            'controller_name'   => 'BoutiqueController',
            'produits'          => $produits,
            'totalNbItems'      => $cartService->getTotalItemCart(),
            'statut'            => $cartService->panierReserveeAfficher() ?? "",
        ]);
    }

    /**
     * @Route("/produit={id}", name="produitId")
     */
    public function produitId($id, ProduitRepository $ProduitRepository, CartService $cartService)
    {
        // Récupére une fiche produit selon ID fourni, puis, on peut parcourir
        // les photos via la propriété '$photos' :
        $produit        = $ProduitRepository->find($id);
        $photosProduits = $produit->getPhotos();

        return $this->render('boutique/produitId.html.twig', [
            'controller_name'   => 'BoutiqueController',
            'id'                => $id,
            'produit'           => $produit,
            'photos'            => $photosProduits,
            'nBPhotos'          => count($photosProduits),
            'totalNbItems'      => $cartService->getTotalItemCart(),
        ]);        
    }
}
