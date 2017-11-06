<?php
# src/CmiApiBundle/Form/Type/Type_praticienType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Type_praticienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('t_prt_id');
        $builder->add('t_prt_code');
        $builder->add('t_prt_libelle');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Type_praticien',
            'csrf_protection' => false
        ]);
    }
}