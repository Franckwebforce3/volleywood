<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireUserRepository")
 */
class CommentaireUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getIdCommentaire(): ?int
    {
        return $this->id_commentaire;
    }

    public function setIdCommentaire(?int $id_commentaire): self
    {
        $this->id_commentaire = $id_commentaire;

        return $this;
    }
}
