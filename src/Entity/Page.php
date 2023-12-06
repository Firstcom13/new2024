<?php

namespace App\Entity;

use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $titre = null;


    #[ORM\Column]
    private ?bool $actif = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $url = null;

    #[ORM\Column(length: 255)]
    private ?string $entete_h1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $entete_h2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $entete_p = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entete_image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entete_bis_h3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $entete_bis_p = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $entete_bis_p_mini = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entete_bis_image = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datecreation = null;

    #[ORM\OneToMany(mappedBy: 'page', targetEntity: BlocsPage::class)]
    private Collection $blocsPages;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ModelesPage $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $backgroundImage = null;

     
    public function __construct()
    {
        $this->blocsPages = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEnteteH1(): ?string
    {
        return $this->entete_h1;
    }

    public function setEnteteH1(string $entete_h1): static
    {
        $this->entete_h1 = $entete_h1;

        return $this;
    }

    public function getEnteteH2(): ?string
    {
        return $this->entete_h2;
    }

    public function setEnteteH2(string $entete_h2): static
    {
        $this->entete_h2 = $entete_h2;

        return $this;
    }

    public function getEnteteP(): ?string
    {
        return $this->entete_p;
    }

    public function setEnteteP(?string $entete_p): static
    {
        $this->entete_p = $entete_p;

        return $this;
    }

    public function getEnteteImage(): ?string
    {
        return $this->entete_image;
    }

    public function setEnteteImage(?string $entete_image): static
    {
        $this->entete_image = $entete_image;

        return $this;
    }

    public function getEnteteBisH3(): ?string
    {
        return $this->entete_bis_h3;
    }

    public function setEnteteBisH3(?string $entete_bis_h3): static
    {
        $this->entete_bis_h3 = $entete_bis_h3;

        return $this;
    }

    public function getEnteteBisP(): ?string
    {
        return $this->entete_bis_p;
    }

    public function setEnteteBisP(?string $entete_bis_p): static
    {
        $this->entete_bis_p = $entete_bis_p;

        return $this;
    }

    
    public function getEnteteBisPMini(): ?string
    {
        return $this->entete_bis_p_mini;
    }

    public function setEnteteBisPMini(?string $entete_bis_p_mini): static
    {
        $this->entete_bis_p_mini = $entete_bis_p_mini;

        return $this;
    }

    public function getEnteteBisImage(): ?string
    {
        return $this->entete_bis_image;
    }

    public function setEnteteBisImage(?string $entete_bis_image): static
    {
        $this->entete_bis_image = $entete_bis_image;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): static
    {
        $this->datecreation = new DateTime();

        return $this;
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

    /**
     * @return Collection<int, BlocsPage>
     */
    public function setBlocsPages(int $blocsPages): static
    {
         $this->blocsPages = $blocsPages;

        return $this;
    }

     public function getBlocsPages(): Collection
    {
        return $this->blocsPages;
    }

    public function addBlocsPage(BlocsPage $blocsPage): static
    {
        if (!$this->blocsPages->contains($blocsPage)) {
            $this->blocsPages->add($blocsPage);
            $blocsPage->setPage($this);
        }

        return $this;
    }

    public function removeBlocsPage(BlocsPage $blocsPage): static
    {
        if ($this->blocsPages->removeElement($blocsPage)) {
            // set the owning side to null (unless already changed)
            if ($blocsPage->getPage() === $this) {
                $blocsPage->setPage(null);
            }
        }

        return $this;
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

    public function __toString(): string
    {
        return $this->titre;
    }

    public function getModele(): ?ModelesPage
    {
        return $this->modele;
    }

    public function setModele(?ModelesPage $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    public function setBackgroundImage(string $backgroundImage): static
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

 


  
}
