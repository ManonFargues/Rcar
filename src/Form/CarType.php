<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\City;
use App\Faker\CarProvider;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model', TextType::class)
            ->add('price', NumberType::class)

            ->add('image', ImageType::class, ['label'=> false])
            ->add('color', ChoiceType::class, [
                'label' => 'Couleur : ',
                'choices' => array_combine(CarProvider::COLOR, CarProvider::COLOR)
            ])
            ->add('carburant', ChoiceType::class, [
                'label' => 'Type de carburant : ',
                'choices'=>array_combine(CarProvider::CARBURANT, CarProvider::CARBURANT)
            ])
            ->add('keywords', CollectionType::class, [
                'entry_type' => KeywordType::class,
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('cities', EntityType::class, [
                'class' => City::class,
                'choice_label' => 'name',
                'label' => 'Ville :',
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
