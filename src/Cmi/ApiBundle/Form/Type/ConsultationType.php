<?php
# src/CmiApiBundle/Form/Type/ConsultationType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cons_temsion_alt');
        $builder->add('cons_temperature');
        $builder->add('cons_poids');
        $builder->add('cons_rdvDate', DateType::class, array(
            // render as a single text box
            'widget' => 'single_text',
        ));
        $builder->add('cons_rdvObjet');
        $builder->add('cons_rdvCommentaire');
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Consultation',
            'csrf_protection' => false
        ]);
    }
}