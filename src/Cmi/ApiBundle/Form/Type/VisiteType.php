<?php
# src/CmiApiBundle/Form/Type/VisiteType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;



class VisiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vstTension');
        $builder->add('vstPoids');
        $builder->add('vstTaille');
        $builder->add('vstPouls');
        $builder->add('vstTemperature');
        $builder->add('vstOphtamologie');
        $builder->add('vstDateRdv', DateType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
        $builder->add('vstHeureRdv', TimeType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
        $builder->add('vstDateFait', DateType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
        $builder->add('vstMotif');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Visite',
            'csrf_protection' => false
        ]);
    }
}