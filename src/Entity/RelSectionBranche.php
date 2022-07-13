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

    #[ORM\ManyToOne(targetEntity: Branche::class, inversedBy: 'secteurs')]
    #[ORM\JoinColumn(name:"id_branche", referencedColumnName:"id_branche",nullable: false)]
    private $branche;

    /**
     * @param string|null $horsect
     * @param string|null $libelle
     */
    public function __construct(?string $horsect, ?string $libelle)
    {
        $this->horsect = $horsect;
        $this->libelle = $libelle;
    }

    public function getIdRelSecBra(): ?int
    {
        return $this->idRelSecBra;
    }

    public function getHorsect(): ?string
    {
        return $this->horsect;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function getBranche(): string
    {
        return $this->branche;
    }

    public function addSecteur(string $libelle, string $horsect, Branche $branche): void
    {
        $this->libelle = $libelle;
        $this->horsect = $horsect;
        $this->branche = $branche;
    }

    public function update(string $libelle, string $horsect, string $branche): void
    {
        $this->libelle = $libelle;
        $this->horsect = $horsect;
        $this->branche = $branche;
    }

}
