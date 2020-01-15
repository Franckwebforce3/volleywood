<?php

namespace App\Repository;

use App\Entity\Produit;

use App\Entity\Magasin;
use App\Entity\Photo;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /****************************************************************
     * METHOD : Renvoi tous les produits qui ont une quantité >= 1
     ****************************************************************
     */
    public function findByAllProducts()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT p.titre, p.description, p.id, p.taille, p.couleur, p.prix_vente, Photo.nom, Photo.description as descriptionPhoto 
            FROM Magasin m
            INNER JOIN Produit p
            ON m.produits_id = p.id
            INNER JOIN Photo
            ON Photo.produit_id = p.id
            WHERE m.quantite >= 1
            ORDER BY p.categorie
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        
            // returns an array of arrays (i.e. a raw data set)
            return $stmt->fetchAll();
    }


    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
