<?php

namespace App\Validator\Secteur;

use App\Repository\RelSectionBrancheRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueHorsectValidator extends ConstraintValidator
{
    /**
     * @var RelSectionBrancheRepository
     */
    private $sectionBrancheRepository;

    public function __construct(RelSectionBrancheRepository $sectionBrancheRepository)
    {
        $this->sectionBrancheRepository = $sectionBrancheRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint UniqueHorsect */

        $existingHorsect = $this->sectionBrancheRepository->findOneBy([
           'horsect' => $value,
        ]);

        if (!$existingHorsect) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
