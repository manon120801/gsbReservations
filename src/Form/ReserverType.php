<?php

namespace App\Form;

use App\Entity\Reservations;
use App\Entity\Utilisateurs;
use App\Entity\Salles;
use App\Entity\Extras;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class ReserverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('nbr_personnes')
            ->add('heure_deb')
            ->add('heure_fin')
            ->add('Utilisateurs', EntityType::class,[
                'class' => Utilisateurs::class,
                'choice_label' => 'nom'
            ])
            ->add('Salles', EntityType::class,[
                'class' => Salles::class,
                'choice_label' => 'code_salle',
            ])
            ->add('Extras', EntityType::class,[
                'class' => Extras::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservations::class,
        ]);
    }
}
