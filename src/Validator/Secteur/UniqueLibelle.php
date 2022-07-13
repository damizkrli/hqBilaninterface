<?php

namespace App\Validator\Secteur;

use Symfony\Component\Validator\Constraint;

/**
 * @Target({"PROPERTY", "ANNOTATION"})
 * @Annotation
 */
class UniqueLibelle extends Constraint
{
    public $message = 'Le secteur "{{ value }}" à déjà été crée.';
}
