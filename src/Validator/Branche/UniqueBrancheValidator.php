<?php

namespace App\Validator\Branche;

    use App\Repository\BrancheRepository;
    use Symfony\Component\Validator\Constraint;
    use Symfony\Component\Validator\ConstraintValidator;

class UniqueBrancheValidator extends ConstraintValidator
{
    /**
     * @var BrancheRepository
     */
    private $brancheRepository;

    public function __construct(BrancheRepository $brancheRepository)
    {
        $this->brancheRepository = $brancheRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint UniqueBranche */

        $existingBranche = $this->brancheRepository->findOneBy([
            'nom' => $value,
        ]);

        if (!$existingBranche) {
            return;
        }

        $this->context->buildViolation($constraint->message)
                      ->setParameter('{{ value }}', $value)
                      ->addViolation();
    }
}
