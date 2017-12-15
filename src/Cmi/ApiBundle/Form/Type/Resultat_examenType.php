<?php
# src/CmiApiBundle/Form/Type/Resultat_examenType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Resultat_examenType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('resEtat');
		$builder->add('resDateFait', DateType::class, array(
		    // render as a single text box
		    'widget' => 'single_text',
		));
		$builder->add('resDatePrFait', DateType::class, array(
		    // render as a single text box
		    'widget' => 'single_text',
		));
		$builder->add('resObservation');
		$builder->add('resCommentaire');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Resultat_examen',
			'csrf_protection' => false
		]);
	}
}