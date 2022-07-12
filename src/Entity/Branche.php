<?php

namespace App\Entity;

use App\Repository\BrancheRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrancheRepository::class)]
class Branche
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id_branche;

    #[ORM\Column(type: 'string', length: 150)]
    private ?string $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $mail;

    #[ORM\OneToMany(mappedBy: 'branche', targetEntity: RelSectionBranche::class)]
    private $secteurs;

    /**
     * @param string|null $nom
     * @param string|null $mail
     */
    public function __construct(?string $nom, ?string $mail)
    {
        $this->nom = $nom;
        $this->mail = $mail;
    }

    public function getIdBranche(): string
    {
        return $this->id_branche;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    /**
     * @return Collection<int, RelSectionBranche>
     */
    public function getSecteurs(): Collection
    {
        return $this->secteurs;
    }
}
