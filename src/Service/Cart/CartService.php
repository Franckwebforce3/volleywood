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
        $idtemp         = intval($id);
        $panier         = $this->session->get('panier', []);
        $panierReservee = $this->session->get('panierReservee', []);

        if( !empty($panier[$idtemp]) ) {
            $panier[$idtemp]++;
        }
        else {
            $panier[$idtemp] = 1;
        }
        
        $panierReservee[0] = '';

        $this->session->set('panierReservee', $panierReservee);
        $this->session->set('panier', $panier);
    }

    public function addWithTaille($id, $taille) 
    {
        $idtemp         = intval($id);
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);
        $panierReservee = $this->session->get('panierReservee', []);

        if( !empty($panier[$idtemp]) ) {
            $panier[$idtemp]++;

            if ($taille != "") {
                if( !empty($panierTaille[$idtemp."-".$taille]) ) {
                    $panierTaille[$idtemp."-".$taille]++;
                }
                else {
                    $panierTaille[$idtemp."-".$taille] = 1;
                }
            }
        }
        else {
            $panier[$idtemp] = 1;

            if ($taille != "") {
                $panierTaille[$idtemp."-".$taille]  = 1;
            }
        }
        
        $panierReservee[0] = '';

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
        $this->session->set('panierReservee', $panierReservee);
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
    public function incrementWithTaille($id, $taille) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        $panierTaille[$id."-".$taille]++;
        $panier[$id]++;
        
        $this->session->set('taille', $panierTaille);
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
    public function removeWithTaille($id, $taille) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);
  
/*        if( intval($panier[$id]) > intval($panierTaille[$id."-".$taille]) ) {

            $panier[$id] = intval($panier[$id]) - intval($panierTaille[$id."-".$taille]);

            unset($panierTaille[$id."-".$taille]);
    
            if( $panier[$id] == 0 ) {
                unset($panier[$id]);
            }
        }
        // elseif ($panier[$id] = $panierTaille[$id."-".$taille] ) {
        else {
            $panier[$id]--;
            $panierTaille[$id."-".$taille]--;

            if( $panier[$id] <= 0 ) {
                unset($panier[$id]);
            }
            if( $panierTaille[$id."-".$taille] <= 0 ) {
                unset($panierTaille[$id."-".$taille]);
            }
        }
*/

        $panierTaille[$id."-".$taille]--;
        $panier[$id]--;

        if( $panier[$id] <= 0 ) {
            unset($panier[$id]);
        }
        if( $panierTaille[$id."-".$taille] <= 0 ) {
            unset($panierTaille[$id."-".$taille]);
        }

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function deleteWithTaille($id, $taille) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        if ($taille == "") {
            // Soustraire le nombre de produit par taille à la somme total de produit :

            if( !empty($panier[$id]) ) {
                unset($panier[$id]);
                // unset($panierTaille[$id]);
            }
        }
        else {
            $panier[$id] = intval($panier[$id]) - intval($panierTaille[$id."-".$taille]);

            unset($panierTaille[$id."-".$taille]);

            if ($panier[$id] == 0) {
                unset($panier[$id]);
            }
        }

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function delete($id) 
    {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        if( !empty($panier[$id]) ) {
            unset($panier[$id]);
            unset($panierTaille[$id]);
        }

        $this->session->set('panier', $panier);
        $this->session->set('taille', $panierTaille);
    }

    public function getFullCart() : array {
        $panier         = $this->session->get('panier', []);
        $panierTaille   = $this->session->get('taille', []);

        $panierWithData = [];

        $trouve         = false;

        // Avant
/*        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'produit'  => $this->produitRepository->find($id),
                'quantity' => $quantity,
                'taille'   => $panierTaille[$id] ?? "",
            ];
        } 
*/
        // apres
        foreach($panier as $id => $quantity) {
            $trouve = false;

            // Rechercher l'id dans les tailles sauvegardées :
            foreach($panierTaille as $id_taille => $quantityByTaille) {
                // $pos = strpos($id_taille, strval($id));
                $tab = explode("-", $id_taille);

                // if ($pos !== false) {
                if ($tab[0] == $id) {
                    // $tab = explode("-", $id_taille);

                    // Sauvegarder :
                    $panierWithData[] = [
                        'produit'  => $this->produitRepository->find($id),
                        'quantity' => $quantityByTaille,
                        'taille'   => $tab[1] ?? "",
                    ];

                    $trouve = true;
                }
            }

            // Si aucune taille trouvée :
            if ($trouve == false) {
                $panierWithData[] = [
                    'produit'  => $this->produitRepository->find($id),
                    'quantity' => $quantity,
                    'taille'   => $panierTaille[$id] ?? "",
                ];
            }
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
        $panier         = $this->session->get('panier', []);

        //$taillePanier   = $this->session->get('taille', []);
        $nbr = 0;

        /* Avant */
/*        foreach($panier as $id => $quantity) {
            $trouve = false;

            // Rechercher l'id dans les tailles sauvegardées :
            foreach($taillePanier as $id_taille => $quantityByTaille) {
                // $pos = strpos($id_taille, strval($id));
                $tab = explode("-", $id_taille);

                // if ($pos !== false) {
                if ($tab[0] == $id) {
                    $nbr++;

                    $trouve = true;
                }
            }

            // Si aucune taille trouvée :
            if ($trouve == false) {
                $nbr++;
            }
        }
*/

        /* Apres */
        foreach($panier as $id => $quantity) {
            $nbr += intval($quantity);
        }

        return $nbr;
    }

    public function panierReservee() {
        $panierReservee = $this->session->get('panierReservee', []);

        $panierReservee[0]= 'ok';

        $this->session->set('panierReservee', $panierReservee);
    }

    public function panierReserveeAfficher() : string {
        $panierReservee = $this->session->get('panierReservee', []);

        if ( !empty($panierReservee[0]) ) {
            return $panierReservee[0];
        }
        else {
            return '';
        }
    }
}