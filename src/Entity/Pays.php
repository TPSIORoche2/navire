<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name:'pays')]
#[Assert\Unique(fiefds:['indicatif'])]
#[ORM\Entity(repositoryClass: PaysRepository::class)]
#[ORM\Index(name:'ind_indicatif',columns:['indicatif'])]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $Nom = null;

    #[ORM\Column(length: 3)]
    #[ORM\Regex(pattern:"/[A-Z]{3}/",message:"L'indicatif Pays a strictement 3 caractères")]
    private ?string $Indicatif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getIndicatif(): ?string
    {
        return $this->Indicatif;
    }

    public function setIndicatif(string $Indicatif): static
    {
        $this->Indicatif = $Indicatif;

        return $this;
    }
}
