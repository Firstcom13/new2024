<?php

namespace App\Entity;

use App\Repository\BlocsPageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocsPageRepository::class)]
class BlocsPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column(nullable: true)]
    private ?int $ordre_affichage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bloc_h3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bloc_p = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bloc_p_mini = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bloc_image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bloc_lien_text = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bloc_lien_url = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datecreation = null;

    #[ORM\ManyToOne(inversedBy: 'blocsPages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Page $page = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $blocColor = null;

    

    //   public function __construct()
    // {
    //     $this->page = new ArrayCollection();
    // }

      public function getId(): ?int
    {
        return $this->id;
    }

    public function isActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): static
    {
        $this->actif = $actif;

        return $this;
    }

    public function getBlocH3(): ?string
    {
        return $this->bloc_h3;
    }

    public function setBlocH3(?string $bloc_h3): static
    {
        $this->bloc_h3 = $bloc_h3;

        return $this;
    }

    public function getBlocP(): ?string
    {
        return $this->bloc_p;
    }

    public function setBlocP(?string $bloc_p): static
    {
        $this->bloc_p = $bloc_p;

        return $this;
    }

    public function getBlocPMini(): ?string
    {
        return $this->bloc_p_mini;
    }

    public function setBlocPMini(?string $bloc_p_mini): static
    {
        $this->bloc_p_mini = $bloc_p_mini;

        return $this;
    }

    public function getBlocImage(): ?string
    {
        return $this->bloc_image;
    }

    public function setBlocImage(?string $bloc_image): static
    {
        $this->bloc_image = $bloc_image;

        return $this;
    }

    public function getBlocLienText(): ?string
    {
        return $this->bloc_lien_text;
    }

    public function setBlocLienText(?string $bloc_lien_text): static
    {
        $this->bloc_lien_text = $bloc_lien_text;

        return $this;
    }

    public function getBlocLienUrl(): ?string
    {
        return $this->bloc_lien_url;
    }

    public function setBlocLienUrl(?string $bloc_lien_url): static
    {
        $this->bloc_lien_url = $bloc_lien_url;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): static
    {
        $this->page = $page;

        return $this;
    }    
    
    /**
         * Sets the ordre_affichage property.
         *
         * @param int|null  The value to set for the ordre_affichage property
         * @return static Returns the current instance
         */
    

    public function getOrdreAffichage(): ?int
    {
        return $this->ordre_affichage;
    }

    public function setOrdreAffichage(?int $ordre_affichage): static
    {
        $this->ordre_affichage = $ordre_affichage;

        return $this;
    }

    public function getBlocColor(): ?string
    {
        return $this->blocColor;
    }

    public function setBlocColor(?string $blocColor): static
    {
        $this->blocColor = $blocColor;

        return $this;
    }



}
