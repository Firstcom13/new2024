<?php

namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\String\Slugger\AsciiSlugger;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[Gedmo\TranslationEntity(class: \App\Entity\Translation::class)]
class Categorie implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Gedmo\Translatable]
    private ?string $nom = null;

    #[Gedmo\Locale]
    private $locale;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateCreation = null;

    #[ORM\ManyToMany(targetEntity: Reference::class, mappedBy: 'categorie')]
    private Collection $reference;

    #[ORM\ManyToMany(targetEntity: ArticlesBlog::class, mappedBy: 'categorie')]
    private Collection $date_creation;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private $slug = null;

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateSlug(): void
    {
        if ($this->nom) {
            $slugger = new AsciiSlugger();
            $this->slug = $slugger->slug($this->nom)->lower();
        }
    }

    public function __construct()
    {
        $this->reference = new ArrayCollection();
        $this->date_creation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        // Mettre à jour le slug chaque fois que le nom est modifié.
        if ($this->locale === null || $this->locale === 'fr') {
            $this->updateSlug();
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): static
    {
        $this->active = $active;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, Reference>
     */
    public function getReference(): Collection
    {
        return $this->reference;
    }

    public function addReference(Reference $reference): static
    {
        if (!$this->reference->contains($reference)) {
            $this->reference->add($reference);
            $reference->addCategorie($this);
        }

        return $this;
    }

    public function removeReference(Reference $reference): static
    {
        if ($this->reference->removeElement($reference)) {
            $reference->removeCategorie($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function addDateCreation(ArticlesBlog $dateCreation): static
    {
        if (!$this->date_creation->contains($dateCreation)) {
            $this->date_creation->add($dateCreation);
            $dateCreation->addCategorie($this);
        }

        return $this;
    }

    public function removeDateCreation(ArticlesBlog $dateCreation): static
    {
        if ($this->date_creation->removeElement($dateCreation)) {
            $dateCreation->removeCategorie($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
}
