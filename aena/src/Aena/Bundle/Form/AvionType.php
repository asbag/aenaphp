<?php

namespace Aena\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AvionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modelo')
            ->add('maxPasajeros')
            ->add('horaSalida')
            ->add('horaLlegada')
            ->add('codigoLicencia')
            ->add('estadoLicencia')
            ->add('caducidadLicencia')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aena\Bundle\Entity\Avion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aena_bundle_avion';
    }
}
