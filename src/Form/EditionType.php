<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Questionnaire;
use App\Entity\Sponsor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('annee')
//             ->add('sponsor', EntityType::class, [
//                 'class' => Sponsor::class,
// 'choice_label' => 'id',
// 'multiple' => true,
//             ])
//             ->add('questionnaire', EntityType::class, [
//                 'class' => Questionnaire::class,
// 'choice_label' => 'id',
//             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Edition::class,
        ]);
    }
}
