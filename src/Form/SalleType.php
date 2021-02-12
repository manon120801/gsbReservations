<?php

namespace App\Form;

use App\Entity\Batiments;
use App\Entity\Salles;
use App\Entity\Surface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_salle')
            ->add('nbr_chaises')
            ->add('nbr_tables')
            ->add('description')
            ->add('photo')
            ->add('Batiments', EntityType::class,[
                'class' => Batiments::class,
                'choice_label' => 'codeBatiment'
            ])
            ->add('Surface', EntityType::class,[
                'class' => Surface::class,
                'choice_label' => 'surface'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Salles::class,
        ]);
    }
}
