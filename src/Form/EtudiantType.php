<?php

namespace App\Form;

use App\Entity\Ecole;
use App\Entity\Etudiant;
use App\Entity\Inscription;
use App\Entity\Section;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])
            ->add('section', EntityType::class, [
                'class' => Section::class,
'choice_label' => 'id',
            ])
            ->add('ecole', EntityType::class, [
                'class' => Ecole::class,
'choice_label' => 'id',
            ])
//             ->add('inscriptions', EntityType::class, [
//                 'class' => Inscription::class,
// 'choice_label' => 'id',
// 'multiple' => true,
//             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
