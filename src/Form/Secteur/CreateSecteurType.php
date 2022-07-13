<?php

namespace App\Form\Secteur;

    use App\Entity\Branche;
    use App\Repository\BrancheRepository;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateSecteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du Secteur',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('horsect', TextType::class, [
                'attr' => [
                    'placeholder' => 'Code Horoquartz',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('branche', EntityType::class, [
                'placeholder' => 'Choisissez une Branche',
                'class' => Branche::class,
                'choice_label' => 'nom',
                'query_builder' => function (BrancheRepository $brancheRepository) {
                    return $brancheRepository->createQueryBuilder('b')
                                             ->orderBy('b.nom', 'ASC')
                                             ->where('b.nom != :exclude')
                                             ->setParameter('exclude', 'ALL');
                },
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
