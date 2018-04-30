<?php
# src/CmiApiBundle/Form/Type/Type_patientType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Type_patientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('tPatCode');
		$builder->add('tPatLibelle');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Type_patient',
			'csrf_protection' => false
		]);
	}
}