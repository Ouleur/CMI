<?php
# src/CmiApiBundle/Form/Type/EntiteType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntiteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('entiCode');
		$builder->add('entiLibelle');
		$builder->add('entiSocieteId');
		$builder->add('entiParentId');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Entite',
			'csrf_protection' => false
		]);
	}
}