<?php
namespace Cmi\ApiBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonnanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ordo_dure');
        $builder->add('ordo_posologie');
        $builder->add('ordo_quantite');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Cmi\ApiBundle\Entity\Ordonnance',
            'csrf_protection' => false
        ]);
    }
}