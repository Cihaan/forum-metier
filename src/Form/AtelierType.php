<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\Edition;
use App\Entity\Metier;
use App\Entity\Salle;
use App\Entity\Secteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('debut')
            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
'choice_label' => 'id',
            ])
            ->add('salle', EntityType::class, [
                'class' => Salle::class,
'choice_label' => 'id',
            ])
            ->add('metier', EntityType::class, [
                'class' => Metier::class,
'choice_label' => 'id',
'multiple' => true,
            ])
            ->add('edition', EntityType::class, [
                'class' => Edition::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
