<?php

namespace App\Dto\Email;

use App\Entity\Branche;
use App\Validator\Branche\UniqueEmail;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEmail()
 */
class AddEmail
{
    /**
     * @var Branche
     */
    private $branche;

    public function __construct(Branche $branche)
    {
        $this->branche = $branche;
    }

    public function getBranche()
    {
        return $this->branche;
    }

    /**
     * @Assert\NotBlank(message="Veuillez saisir une adresse email.")
     */
    public $mail;
}
