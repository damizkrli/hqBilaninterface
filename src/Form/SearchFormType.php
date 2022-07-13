<?php

namespace App\Form;

    use App\Data\SearchData;
    use App\Entity\Branche;
    use App\Repository\BrancheRepository;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Secteur ou code Horoquartz',
                ],
            ])
            ->add('branches', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Branche::class,
                'expanded' => true,
                'multiple' => true,
                // tri des branches par ordre alphabétique et supprime ALL
                'query_builder' => function (BrancheRepository $brancheRepository) {
                    return $brancheRepository->createQueryBuilder('b')
                                             ->orderBy('b.nom', 'ASC')
                                             ->where('b.nom != :exclude')
                                             ->setParameter('exclude', 'ALL')
                    ;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
