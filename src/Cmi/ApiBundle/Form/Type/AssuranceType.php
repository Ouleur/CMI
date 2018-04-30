<?php
# src/CmiApiBundle/Form/Type/AssuranceType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssuranceType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('assureCode');
		$builder->add('assureLibelle');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Assurance',
			'csrf_protection' => false
		]);
	}
}