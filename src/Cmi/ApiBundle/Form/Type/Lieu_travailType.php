<?php
# src/CmiApiBundle/Form/Type/Lieu_travailType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Lieu_travailType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('lTravCode');
		$builder->add('lTravLibelle');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Lieu_travail',
			'csrf_protection' => false
		]);
	}
}