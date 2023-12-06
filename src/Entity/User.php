<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(message: 'Veuillez rentrer un email valide.')]
    #[Assert\NotBlank(message: 'Veuillez renseigner votre email.')]
    private $email;

     #[ORM\Column(type: 'json')]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 255,type: "string")]
    #[Assert\Length(min: 6, minMessage: 'Le mot de passe doit faire au moins 6 caractères.')]
    #[Assert\NotBlank(message: 'Veuillez renseigner un mot de passe.')]
    private $password;


  #[ORM\Column(length: 255,type: 'string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner votre prénom.')]
  private $firstname;

  #[ORM\Column(length: 255,type: 'string')]
  #[Assert\NotBlank(message: 'Veuillez renseigner votre nom.')]
  private $lastname;

  #[ORM\Column(type: "datetime")]
    private $dateCreation;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
           return $this->roles;
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
        ;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
        ;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDateCreation(): ?DateTime
    {
        return $this->dateCreation;
    }

    #[ORM\PrePersist]
    public function setDateCreation(): void
    {
        $this->dateCreation = new DateTime();
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
