<?php

namespace App\Form;

use App\Entity\District;
use App\Entity\PublicHouse;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PublicHouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zipCode')
            ->add('street')
            ->add('streetNumber')
            ->add('city')
            ->add('email')
            ->add('name')
            ->add('district', EntityType::class,[
                "class"=> District::class,
                "choice_label"=>"name"
            ])
            ->add('type', EntityType::class,[
                "class"=> Type::class,
                "choice_label"=>"name"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PublicHouse::class,
        ]);
    }
}
