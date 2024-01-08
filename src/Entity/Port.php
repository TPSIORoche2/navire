<?php

namespace App\Entity;

use App\Repository\PortRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass:PortRepository::class)]
#[Assert\Unique(fiefds:['indicatif'])]
#[ORM\Index(name:'ind_INDICATIF',columns:['indicatif'])]
class Port
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name:'id')]
    private ?int $id = null;

    #[ORM\Column(name:'nom',length: 70)]
    private ?string $nom = null;

    #[ORM\Column(name:'indicatif',length: 5)]
    #[ORM\Regex(pattern:'/[A-Z]{5}/',message:"L'indicatif Port a strictement 5 caractères")]
    private ?string $indicatif = null;

    #[ORM\ManyToMany(targetEntity: AisShipType::class, inversedBy: 'portsCompatibles')]
    #[ORM\JoinTable(name:'porttypecompatible')]
    #[ORM\JoinColumn(name:'idport',referencedColumnName:'id')]
    #[ORM\InverseJoinColumn(name:'idaisshiptype',referencedColumnName:'id')]
    private Collection $types;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name:'idpays',nullable: false)]
    private ?Pays $idpays = null;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Navire::class)]
    private Collection $navires;

    #[ORM\OneToMany(mappedBy: 'idport', targetEntity: Escale::class, orphanRemoval: true)]
    private Collection $escales;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->navires = new ArrayCollection();
        $this->escales = new ArrayCollection();
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

        return $this;
    }

    public function getIndicatif(): ?string
    {
        return $this->indicatif;
    }

    public function setIndicatif(string $indicatif): static
    {
        $this->indicatif = $indicatif;

        return $this;
    }

    /**
     * @return Collection<int, AisShipType>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(AisShipType $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(AisShipType $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getIdpays(): ?Pays
    {
        return $this->idpays;
    }

    public function setIdpays(?Pays $idpays): static
    {
        $this->idpays = $idpays;

        return $this;
    }

    /**
     * @return Collection<int, Navire>
     */
    public function getNavires(): Collection
    {
        return $this->navires;
    }

    public function addNavire(Navire $navire): static
    {
        if (!$this->navires->contains($navire)) {
            $this->navires->add($navire);
            $navire->setDestination($this);
        }

        return $this;
    }

    public function removeNavire(Navire $navire): static
    {
        if ($this->navires->removeElement($navire)) {
            // set the owning side to null (unless already changed)
            if ($navire->getDestination() === $this) {
                $navire->setDestination(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Escale>
     */
    public function getEscales(): Collection
    {
        return $this->escales;
    }

    public function addEscale(Escale $escale): static
    {
        if (!$this->escales->contains($escale)) {
            $this->escales->add($escale);
            $escale->setIdport($this);
        }

        return $this;
    }

    public function removeEscale(Escale $escale): static
    {
        if ($this->escales->removeElement($escale)) {
            // set the owning side to null (unless already changed)
            if ($escale->getIdport() === $this) {
                $escale->setIdport(null);
            }
        }

        return $this;
    }
}
