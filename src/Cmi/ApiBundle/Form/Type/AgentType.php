<?php
# src/CmiApiBundle/Form/Type/AgentType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('agentEntiteId');
		$builder->add('agentAyDtIds');
		$builder->add('agentLTravId');
		$builder->add('agentCarteId');
		$builder->add('agentTContratId');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Agent',
			'csrf_protection' => false
		]);
	}
}