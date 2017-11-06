<?php
# src/CmiApiBundle/Form/Type/ConsultationType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cons_motif_ids');
        $builder->add('cons_infirmier_id');
        $builder->add('cons_specialite_id');
        $builder->add('cons_medecin_id');
        $builder->add('cons_date');
        $builder->add('cons_patient_id');
        $builder->add('cons_etape_id');
        $builder->add('cons_pharmacien_id');
        $builder->add('cons_ordonnance_ids');
        $builder->add('cons_diagnost_ids');
        $builder->add('cons_soins_ids');
        $builder->add('cons_exam_res_ids');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Consultation',
            'csrf_protection' => false
        ]);
    }
}