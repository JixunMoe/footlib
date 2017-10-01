<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class PlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array(
                'constraints' => new Assert\NotBlank()
            ))
            ->add('skill_level', IntegerType::class, array(
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Type(array(
                        'type' => 'integer',
                    )),
                    new Assert\Range(array(
                        'min' => 0,
                    )),
                ),
                'attr' => array(
                    'min' => 0,
                ),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_player_type';
    }
}
