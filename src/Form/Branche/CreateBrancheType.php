<?php

namespace App\Form\Branche;

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Email;
    use Symfony\Component\Validator\Constraints\NotBlank;

class CreateBrancheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom de la branche',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('mail', EmailType::class, [
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez saisir une adresse mail valide.',
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez saisir une adresse email.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Adresses mails associées',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'required' => false,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
