<?php
# src/CmiApiBundle/Form/Type/AccidentTravailType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccidentTravailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder->add('acte_id');
        $builder->add('atCirconstance');
        $builder->add('atReference');
        $builder->add('lieu_accident');
        $builder->add('nature_travail_accident');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\AccidentTravail',
            'csrf_protection' => false
        ]);
    }
}