<?php

namespace App\Entity;

use App\Repository\RelSectionBrancheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelSectionBrancheRepository::class)]
class RelSectionBranche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $idRelSecBra;

    #[ORM\Column(type: 'string', length: 12)]
    private ?string $horsect;

    #[ORM\Column(type: 'string', length: 100)]
    private ?string $libelle;

    public function getIdRelSecBra(): ?int
    {
        return $this->idRelSecBra;
    }

    public function getHorsect(): ?string
    {
        return $this->horsect;
    }

    public function setHorsect(string $horsect): self
    {
        $this->horsect = $horsect;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}
