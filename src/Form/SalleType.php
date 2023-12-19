<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\Ecole;
use App\Entity\Salle;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('etage')
            ->add('capacite')
            ->add('ecole', EntityType::class, [
                'class' => Ecole::class,
'choice_label' => 'id',
            ])
//             ->add('atelier', EntityType::class, [
//                 'class' => Atelier::class,
// 'choice_label' => 'id',
//             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salle::class,
        ]);
    }
}
