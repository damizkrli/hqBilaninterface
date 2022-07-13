<?php

namespace App\Dto\RelSectionBranche;

use App\Validator\Secteur\UniqueHorsect;
use App\Validator\Secteur\UniqueLibelle;
use Symfony\Component\Validator\Constraints as Assert;

class EditSecteur
{
    /**
     * @UniqueLibelle()
     * @Assert\NotBlank(message="Veuillez sélectionner le nom du secteur.")
     */
    public $libelle;

    /**
     * @UniqueHorsect()
     * @Assert\NotBlank(message="Veuillez saisir un code horoquartz valide.")
     */
    public $horsect;

    /**
     * @Assert\NotBlank(message="Veuillez selectionner la branche de référence.")
     */
    public $branche;
}
