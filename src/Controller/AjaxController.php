<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

// POUR POUVOIR RENVOYER DU JSON
use Symfony\Component\HttpFoundation\JsonResponse;
// POUR FAIRE DES REQUETES DBAL
use Doctrine\DBAL\Driver\Connection;

// POUR RECUPERER LES INFOS DE FORMDATA
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajaxAfficherProduitId")
     */
    public function index(Connection $connection, Request $request)
    {
        // RECUPERER L'INFO nomTable ENVOYEE DANS FormData
        $idProduit = $request->get("idProduit");
        // dump($idProduit);

        // ON VEUT RENVOYER DU JSON
        // https://symfony.com/doc/current/components/http_foundation.html#creating-a-json-response
        $tabAsso = [];
        // $tabAsso["info1"]   = "coucou";

$req =
<<<CODESQL
SELECT 
produit.id, titre, produit.description, categorie, taille, couleur, prix_vente, photo.nom, magasin.quantite
FROM produit 
INNER JOIN photo 
ON produit.id = photo.produit_id 
INNER JOIN magasin 
ON produit.id = magasin.produits_id
WHERE produit.id = $idProduit
CODESQL;

        // ON EST REVENU DANS LE MONDE SQL
        // ATTENTION: PAS SECURISE
        $produitPhotos = $connection->fetchAll($req);
        // $produitPhotos = $connection->fetchAll("SELECT id, titre, produit.description, categorie, taille, couleur, prix_vente FROM produit WHERE produit.id = $idProduit");
        $tabAsso["produitPhotos"] = $produitPhotos;

        // JE VOUDRAIS RENVOYER LA LISTE DES ANNONCES
        // https://symfony.com/doc/current/doctrine/dbal.html
        // https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/index.html
        // https://www.doctrine-project.org/projects/doctrine-dbal/en/2.10/reference/data-retrieval-and-manipulation.html#data-retrieval-and-manipulation

        $response = new JsonResponse($tabAsso);
        return $response;

        /*
        // ON NE VEUT PAS RENVOYER DU HTML
        return $this->render('ajax/index.html.twig', [
            'controller_name' => 'AjaxController',
        ]);
        */
    }
}
