<?php

namespace App\Validator\Branche;

use Symfony\Component\Validator\Constraint;

/**
 * @Target({"PROPERTY", "ANNOTATION"})
 * @Annotation
 */
class UniqueBranche extends Constraint
{
    public $message = 'La branche "{{ value }}" existe déjà. Veuillez utiliser un autre nom.';
}
