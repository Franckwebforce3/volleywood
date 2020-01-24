<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

// A RAJOUTER POUR POUVOIR UTILISER LES CONTRAINTES SUR MON ENTITE
// https://symfony.com/doc/current/reference/constraints/Email.html
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *      fields={"email"}, 
 *      message="Désolé l'email est déjà utilisé..."
 * )
 * @UniqueEntity(
 *      fields={"pseudo"}, 
 *      message="Désolé ce pseudo est déjà utilisé..."
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(
     *     message = "ARRETE DE HACKER MON EMAIL '{{ value }}'"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string")
     * @var string The hashed password
     */
    private $password;
    
    /**
     */
    private $confirmPassword;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *      minMessage = "Ton mot de passe doit avoir au moins {{ limit }} caractères",
     *      maxMessage = "Ton mot de passe doit avoir au moins {{ limit }} caractères",
     * )
     */

    private $cp;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentaire", mappedBy="users", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="string", length=160)
     */
    private $cle_activation;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    // AJOUT DE GETTER SETTER CONFIRM_PASSWORD
    public function getConfirmPassword(): string
    {
        return (string) $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): self
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setUsers($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getUsers() === $this) {
                $commentaire->setUsers(null);
            }
        }

        return $this;
    }

    public function getCleActivation(): ?string
    {
        return $this->cle_activation;
    }

    public function setCleActivation(string $cle_activation): self
    {
        $this->cle_activation = $cle_activation;

        return $this;
    }
}
