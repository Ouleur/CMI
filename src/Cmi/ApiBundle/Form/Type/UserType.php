<?php
# src/Cmi/ApiBundle/Form/Type/UserType.php

namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
* 
*/
class UserType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder,array $options)
	{
		# code...
		$builder->add("firstname");
		$builder->add("lastname");
		$builder->add("plainPassword");
		$builder->add("email", EmailType::class);
	}

	public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\User',
            'csrf_protection' => false
        ]);
    }
}