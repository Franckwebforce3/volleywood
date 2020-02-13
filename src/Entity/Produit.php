<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $taille;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $couleur;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prixVente;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photo", mappedBy="produit")
     */
    private $photos;

    // /**
    //  * @ORM\ManyToMany(targetEntity="App\Entity\Commande", mappedBy="produits")
    //  */
    // private $commandes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Magasin", mappedBy="produits", cascade={"persist", "remove"})
     */
    private $magasins;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandeProduit", mappedBy="produits")
     */
    private $commandeProduits;

    public function __construct()
    {
        $this->produit_id       = new ArrayCollection();
        $this->photos           = new ArrayCollection();
        $this->commandes        = new ArrayCollection();
        $this->commandeProduits = new ArrayCollection();
        $this->magasins         = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getPrixVente(): ?string
    {
        return $this->prixVente;
    }

    public function setPrixVente(string $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setProduit($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getProduit() === $this) {
                $photo->setProduit(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection|Commande[]
    //  */
    // public function getCommandes(): Collection
    // {
    //     return $this->commandes;
    // }

    // public function addCommande(Commande $commande): self
    // {
    //     if (!$this->commandes->contains($commande)) {
    //         $this->commandes[] = $commande;
    //         $commande->addProduit($this);
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     if ($this->commandes->contains($commande)) {
    //         $this->commandes->removeElement($commande);
    //         $commande->removeProduit($this);
    //     }

    //     return $this;
    // }

    // public function getMagasin(): ?Magasin

    /**
     * @return Collection|Magasin[]
     */
    public function getMagasin(): Collection
    {
        return $this->magasins;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasins = $magasin;

        // set (or unset) the owning side of the relation if necessary
        $newProduits = null === $magasin ? null : $this;
        if ($magasin->getProduits() !== $newProduits) {
            $magasin->setProduits($newProduits);
        }

        return $this;
    }

    /**
     * @return Collection|CommandeProduit[]
     */
    public function getCommandeProduits(): Collection
    {
        return $this->commandeProduits;
    }

    public function addCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if (!$this->commandeProduits->contains($commandeProduit)) {
            $this->commandeProduits[] = $commandeProduit;
            $commandeProduit->setProduits($this);
        }

        return $this;
    }

    public function removeCommandeProduit(CommandeProduit $commandeProduit): self
    {
        if ($this->commandeProduits->contains($commandeProduit)) {
            $this->commandeProduits->removeElement($commandeProduit);
            // set the owning side to null (unless already changed)
            if ($commandeProduit->getProduits() === $this) {
                $commandeProduit->setProduits(null);
            }
        }

        return $this;
    }

}
