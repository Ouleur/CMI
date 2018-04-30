<?php
# src/CmiApiBundle/Form/Type/Type_contratType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Type_contratType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('tContratCode');
		$builder->add('tContratLibelle');
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Type_contrat',
			'csrf_protection' => false
		]);
	}
}