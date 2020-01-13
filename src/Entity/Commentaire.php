<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentaireRepository")
 */
class Commentaire
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
    private $poceBleu;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $idReponse;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datePublication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoceBleu(): ?int
    {
        return $this->poceBleu;
    }

    public function setPoceBleu(?int $poceBleu): self
    {
        $this->poceBleu = $poceBleu;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getIdReponse(): ?int
    {
        return $this->idReponse;
    }

    public function setIdReponse(?int $idReponse): self
    {
        $this->idReponse = $idReponse;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        return $this->datePublication;
    }

    public function setDatePublication(\DateTimeInterface $datePublication): self
    {
        $this->datePublication = $datePublication;

        return $this;
    }
}
