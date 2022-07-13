<?php

namespace App\Validator\Secteur;

use App\Repository\RelSectionBrancheRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueLibelleValidator extends ConstraintValidator
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
        /* @var $constraint UniqueLibelle */

        $existingLibelle = $this->sectionBrancheRepository->findOneBy([
            'libelle' => $value,
        ]);

        if (!$existingLibelle) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation()
        ;
    }
}
