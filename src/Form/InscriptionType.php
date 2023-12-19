<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('statut_chiffrement')
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
'choice_label' => 'id',
            ])
            ->add('atelier', EntityType::class, [
                'class' => Atelier::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
