<?php

namespace App\Form;

use App\Entity\Ecole;
use App\Entity\Etudiant;
use App\Entity\Reponse;
use App\Entity\Section;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('utilisateur', EntityType::class, [
                'class' => Utilisateur::class,
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
//             ->add('reponses', EntityType::class, [
//                 'class' => Reponse::class,
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
