<?php

namespace App\Validator\Branche;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class UniqueEmail extends Constraint
{
    public $message = '{{ value }} existe déjà pour cette branche.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
