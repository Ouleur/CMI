<?php
# src/CmiApiBundle/Form/Type/PatientType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('patMatricule');
		$builder->add('patPhoto');
		$builder->add('patNom');
		$builder->add('patPrenoms');
		$builder->add('patDateNaiss');
		$builder->add('patLieuNaiss');
		$builder->add('patCivilite');
		$builder->add('patGrpSanguin');
		$builder->add('patNbreEnfant');
		$builder->add('patContact');
		$builder->add('patSitMat');
		$builder->add('patEmail');
		$builder->add('patLocalite');
		$builder->add('patSexe');
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'Cmi\ApiBundle\Entity\Patient',
			'csrf_protection' => false
		]);
	}
}