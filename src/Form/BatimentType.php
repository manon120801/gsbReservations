<?php

namespace App\Form;

use App\Entity\Batiments;
use App\Entity\Agences;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BatimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code_batiment')
            ->add('nbr_salles')
            ->add('nbr_etages')
            ->add('acsenseur')
            ->add('description')
            ->add('photo')
            ->add('Agences', EntityType::class,[
                'class' => Agences::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Batiments::class,
        ]);
    }
}
