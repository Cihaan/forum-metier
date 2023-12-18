<?php

namespace App\Form;

use App\Entity\Test1;
use App\Entity\Test2;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Test1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('one_to_many', EntityType::class, [
                'class' => Test2::class,
'choice_label' => 'id',
            ])
            ->add('test2', EntityType::class, [
                'class' => Test2::class,
'choice_label' => 'id',
            ])
            ->add('test2s', EntityType::class, [
                'class' => Test2::class,
'choice_label' => 'id',
'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test1::class,
        ]);
    }
}
