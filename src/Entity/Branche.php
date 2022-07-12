<?php

namespace App\Entity;

use App\Repository\BrancheRepository;
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

    public function getIdBranche(): ?int
    {
        return $this->id_branche;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }
}
