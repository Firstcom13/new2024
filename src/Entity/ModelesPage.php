<?php

namespace App\Entity;

use App\Repository\ModelesPageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelesPageRepository::class)]
class ModelesPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $url = null;

     public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function __toString(): string
    {
        return $this->titre ?: '';  // Utiliser le titre comme représentation en chaîne de caractères, ou une chaîne vide si le titre n'est pas défini.
    }

}
