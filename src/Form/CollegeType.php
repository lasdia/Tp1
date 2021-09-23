<?php

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CollegeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
   
        $builder
            ->add('nom',TextType::class,[
                'label' => 'nom'
            ])
            ->add('prenom',TextType::class,[
                'label' => 'prenom'
            ])
            ->add('datedenaissance',DateType::class,[
                'label' => 'Date de naissance',
                'input_format' => 'd/m/Y'
            ])

            ->add('submit',SubmitType::class,[
            'label' => 'envoyer'
            ]);


        
    }
}