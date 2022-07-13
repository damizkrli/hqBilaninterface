<?php

namespace App\Dto\RelSectionBranche;

use App\Validator\Secteur\UniqueHorsect;
use App\Validator\Secteur\UniqueLibelle;
use Symfony\Component\Validator\Constraints as Assert;

class AddSecteur
{
    /**
     * @UniqueLibelle()
     * @Assert\NotBlank(message="Veuillez selectionner le nom du secteur.")
     */
    public $libelle;

    /**
     * @UniqueHorsect()
     * @Assert\NotBlank(message="Veuillez saisir un code Horoquartz")
     */
    public $horsect;

    /**
     * @Assert\NotBlank(message="Veuillez selectionner une branche")
     */
    public $branche;
}
