<?php

namespace App\Validator\Branche;

    use App\Dto\Email\AddEmail;
    use App\Repository\BrancheRepository;
    use Symfony\Component\Validator\Constraint;
    use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
{
    /**
     * @var BrancheRepository
     */
    private $brancheRepository;

    public function __construct(BrancheRepository $brancheRepository)
    {
        $this->brancheRepository = $brancheRepository;
    }

    /**
     * @param  AddEmail   $value
     * @param  Constraint $constraint
     * @return void
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint UniqueEmail */

        if (in_array($value->mail, $value->getBranche()->getMails())) {
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ value }}', $value->mail)
                          ->addViolation();
        }
    }
}
