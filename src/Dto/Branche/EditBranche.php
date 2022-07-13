<?php

namespace App\Dto\Branche;

use App\Validator\Branche\UniqueBranche;
use Symfony\Component\Validator\Constraints as Assert;

class EditBranche
{
    /**
     * @UniqueBranche()
     * @Assert\NotBlank(message="Veuillez saisir le nom de la branche.")
     * @Assert\Length(
     *     min = 2,
     *     max = 10,
     *     minMessage= "Le nom de votre branche doit contenir au moins {{ limit }} caractères.",
     *     maxMessage= "Le nom de votre ne doit pas contenir plus de {{ limit }} caractères."
     * )
     */
    public $nom;
}
