<?php

namespace App\Validator\Secteur;

use Symfony\Component\Validator\Constraint;

/**
 * @Target({"PROPERTY", "ANNOTATION"})
 * @Annotation
 */
class UniqueHorsect extends Constraint
{
    public $message = 'Le code Horoquartz "{{ value }}" à déjà été crée.';
}
