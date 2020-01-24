<?php

namespace App\Controller;

//use App\Entity\User;
use App\Entity\Commande;
use App\Entity\CommandeProduit;
use App\Service\Cart\CartService;
use App\Repository\ProduitRepository;


// POUR ENVOYER UN EMAIL :
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/boutique")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CartService $cartService)
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotalCart(),
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        //dump($id);
        $cartService->add($id);
        
        return $this->redirectToRoute("nosProduits");
    }   
    
    /**
     * @Route("/panier/tailleChange/{id}_{taille}", name="cart_tailleChange")
     */
    public function tailleChange($id, $taille, CartService $cartService)
    {
        $cartService->tailleChange($id, $taille);
        
        return $this->redirectToRoute("cart_index");
    } 

    /**
     * @Route("/panier/tailleChangebyProduct/{id}_{taille}", name="cart_tailleChangeProduct")
     */
    public function tailleChangeProduct($id, $taille, CartService $cartService)
    {
        $cartService->tailleChange($id, $taille);
        
        return $this->redirectToRoute("produitId", ['id' => $id]);
        // return $this->redirectToRoute("cart_index");
    } 

    /**
     * @Route("/panier/increment/{id}", name="cart_increment")
     */
    public function increment($id, CartService $cartService)
    {
        $cartService->increment($id);
        
        return $this->redirectToRoute("cart_index");
    }   

    /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */    
    public function remove($id, CartService $cartService) {
        $cartService->remove($id);

        return $this->redirectToRoute("cart_index");
    }
    
    /**
     * @Route("/panier/delete/{id}", name="cart_delete")
     */    
    public function delete($id, CartService $cartService) {
        $cartService->delete($id);

        return $this->redirectToRoute("cart_index");
    }    

    private function deleteAllCart($id, CartService $cartService) {
        $cartService->delete($id);
    }  

    /**
     * @Route("/panier/reserve", name="cart_reserve")
     */    
    public function reserve(CartService $cartService, ProduitRepository $ProduitRepository, MailerInterface $mailer) {
        // Récupérer les données du client connecté :
        $clientConnecte = $this->getUser();

        // Récupérer le panier complet :
        $items = $cartService->getFullCart();

        // Entité de gestion de bdd :
        $entityManager = $this->getDoctrine()->getManager();

        // Via la session, enregistré le panier :
        //$dateImmutable = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime('now'));
        $commandes = new Commande();
        $commandes->setEtat(1);
        $commandes->setUser($clientConnecte);
        $ref = "REF-" . date('jmY-His');
        $commandes->setRefcommande($ref);
        $commandes->setDateLivraison(new \DateTime());

        // Pouvoir utiliser le nouvel objet après :
        $entityManager->persist($commandes);
        // Stocker en Bdd :
        $entityManager->flush();

        /** 
         * Nouvelle commande créée :
        */
        // $idNouvelleCommande = $commandes->getId();

        /**
         * Stocker maintenant la table d'association :
         */
        $contenu = '<p>Bonjour,</p><p>Merci d\'avoir passé commande sur notre site Internet.</p>';
        $contenu .= '<p>Vous recevrez un mail lorsque votre commande sera prête ...</p>';
        $contenu .= '<p>Ma commande :<br>';
        foreach($items as $id => $valeur) {
            $contenu .= $items[intval($id)]["produit"]->getTitre() .': Quantité = '. $items[intval($id)]["quantity"];
            if ($items[intval($id)]["taille"] != "")
            {
                $contenu .= ', Taille = '. $items[intval($id)]["taille"] .'<br>';
            }
            else {
                $contenu .= '<br>';
            }

            $produit            = $ProduitRepository->find( intval($items[intval($id)]["produit"]->getId()) );
            $CommandeProduit    = new CommandeProduit();
            $CommandeProduit->setCommandes($commandes);
            $CommandeProduit->setProduits($produit);
            $CommandeProduit->setQuantite(intval($items[intval($id)]["quantity"]));
            $CommandeProduit->setTaille($items[intval($id)]["taille"]);

            // Pouvoir utiliser le nouvel objet après :
            $entityManager->persist($CommandeProduit);
            // Stocker en Bdd :
            $entityManager->flush();

            // Supprimer le produit du panier :
            $cartService->delete(intval($items[intval($id)]["produit"]->getId()));
        }
        $contenu .= '</p><p>Cordialement<br>VolleyWood</p>';

        $email = (new Email())
            ->from('volley.wood13@gmail.com')
            ->to($clientConnecte->getEmail())
            ->subject("VolleyWood : Réserver ma commande !")
            ->text("Bonjour, Merci d\'avoir passé commande sur notre site Internet. Cordialement. VolleyWood")
            ->html($contenu);
            // ON PEUT UTILISER DES TEMPLATES TWIG POUR CREER LE HTML DES EMAILS
            // https://symfony.com/doc/current/mailer.html#twig-html-css

        $sentEmail = $mailer->send($email);
        
        return $this->redirectToRoute("nosProduits");
    }   
}
