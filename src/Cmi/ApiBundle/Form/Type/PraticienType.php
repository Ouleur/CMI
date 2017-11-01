<?php
# src/CmiApiBundle/Form/Type/PraticienType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PraticienType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('pratNom');
		$builder->add('pratPrenoms');
		$builder->add('pratContact');
		$builder->add('pratEmail');
		$builder->add('pratTypeId');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Praticien',
			'csrf_protection' => false
		]);
	}
}