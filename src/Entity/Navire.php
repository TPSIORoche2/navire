<?php

namespace App\Entity;

use App\Repository\NavireRepository;
use Doctrine\ORM\Mapping as ORM;

#[Assert\Unique(fiefds:['imo','mmsi','indicatifAppel'])]
#[ORM\Entity(repositoryClass: NavireRepository::class)]
#[ORM\Index(name:'ind_IMO',columns:['imo'])]
#[ORM\Index(name:'ind_MMST',columns:['mmsi'])]
class Navire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column (name:'id')]
    private ?int $id = null;

    #[ORM\Column(name:'imo',length: 7)]
    #[Assert\Regex('[1-9][0-9][6]',message:'le numéro IMO doit être uniqueet composé de 7 sans commencer par 0')]
    private ?string $IMO = null;

    #[ORM\Column(name:'nom',length: 255)]
    #[Assert\Regex('[a-zA-Z0-9]{3,}$',message:' 3 caractères alphanumériques au minimum')]
    private ?string $nom = null;

    #[ORM\Column(name:'mmsi',length: 9)]
    #[Assert\Regex('[1-9][0-9][9]',message:'le numéro MMSI doit être uniqueet composé de 9 sans commencer par 0')]
    private ?string $MMSI = null;

    #[ORM\Column(name:'indicatifAppel',length: 10)]
    #[Assert\Regex('^[a-zA-Z0-9]{10}$',message:' 10 caractères alphanumériques au minimum')]
    private ?string $incatifAppel = null;

    #[ORM\Column(name:'eta',length: 255)]
    private ?DateTime $Eta = null;

    #[ORM\Column]
    private ?int $longueur = null;

    #[ORM\Column]
    private ?int $largeur = null;

    #[ORM\Column]
    private ?float $tirantdeau = null;

    #[ORM\ManyToOne(inversedBy: 'navires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AisShipType $type = null;

    #[ORM\ManyToOne(inversedBy: 'navires',cascade:['persist'])]
    #[ORM\JoinColumn(name:'idport',referencedColumnName:'id',nullable:true)]
    private ?Port $destination = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIMO(): ?string
    {
        return $this->IMO;
    }

    public function setIMO(string $IMO): static
    {
        $this->IMO = $IMO;

        return $this;
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

    public function getMMSI(): ?string
    {
        return $this->MMSI;
    }

    public function setMMSI(string $MMSI): static
    {
        $this->MMSI = $MMSI;

        return $this;
    }

    public function getIndicatifAppel(): ?string
    {
        return $this->incatifAppel;
    }

    public function setIndicatifAppel(string $idappele): static
    {
        $this->incatifAppel = $idappele;

        return $this;
    }

    public function getEta(): ?string
    {
        return $this->Eta;
    }

    public function setEta(string $Eta): static
    {
        $this->Eta = $Eta;

        return $this;
    }

    public function getLongueur(): ?int
    {
        return $this->longueur;
    }

    public function setLongueur(int $longueur): static
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getLargeur(): ?int
    {
        return $this->largeur;
    }

    public function setLargeur(int $largeur): static
    {
        $this->largeur = $largeur;

        return $this;
    }

    public function getTirantdeau(): ?float
    {
        return $this->tirantdeau;
    }

    public function setTirantdeau(float $tirantdeau): static
    {
        $this->tirantdeau = $tirantdeau;

        return $this;
    }

    public function getType(): ?AisShipType
    {
        return $this->type;
    }

    public function setType(?AisShipType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDestination(): ?Port
    {
        return $this->destination;
    }

    public function setDestination(?Port $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

}
