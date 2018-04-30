<?php
# src/CmiApiBundle/Form/Type/ArretType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ArretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder->add('acte_id');
        $builder->add('arretDebut', DateType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
        $builder->add('arretFin', DateType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Arret',
            'csrf_protection' => false
        ]);
    }
}