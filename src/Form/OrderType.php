<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Size;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fname', TextType::class , ['label' => 'Voornaam'])
            ->add('lname', TextType::class , ['label' => 'Achternaam'])
            ->add('adress', TextType::class , ['label' => 'Adress'])
            ->add('zipcode', TextType::class , ['label' => 'Zipcode'])
            ->add('size', EntityType::class, [
                'class'=>Size::class,
                'choice_label' => 'name',
            ])
            ->add('Send', SubmitType::class)
//            ->add('pizza')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
