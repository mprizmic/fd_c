<?php

namespace Fd\TablaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SectorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('descripcion', null, array(
                    'label' => 'Descripción',
                ))
                ->add('abreviatura')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\TablaBundle\Entity\Sector'
        ));
    }

    public function getName() {
        return 'fd_tablabundle_sectortype';
    }

}
