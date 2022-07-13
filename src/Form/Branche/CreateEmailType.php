<?php

namespace App\Form\Branche;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;

class CreateEmailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail', TextType::class, [
                'constraints' => [
                    new Email([
                        'message' => 'Veuillez saisir une adresse mail valide.',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Adresse Email',
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
