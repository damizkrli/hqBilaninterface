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

    public function getMails(): array
    {
        return explode(';', $this->mail);
    }

    public function getNumberMails(): int
    {
        return count($this->getMails());
    }

    public function getSecteurs()
    {
        return $this->secteurs;
    }

    public function update(string $nom): void
    {
        $this->nom = $nom;
    }

    public function addBranche(string $nom, string $mail): void
    {
        $this->nom = $nom;
        $this->mail = $mail;
    }

    public function addEmail(?string $mail): void
    {
        $this->mail .= ';' . $mail;
    }

    public function deleteEmail(string $userMailSelected): void
    {
        $emails = $this->getMails();
        $filterMails = [];

        foreach ($emails as $email) {
            if ($email !== $userMailSelected) {
                $filterMails[] = $email;
            }
        }
        $this->mail = $filterMails;

        return;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
