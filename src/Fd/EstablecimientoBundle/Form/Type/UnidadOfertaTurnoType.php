<?php

namespace Fd\EstablecimientoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;

class UnidadOfertaTurnoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('turno', null, array(
                    'label'=>' ',
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno',
        ));
    }

    public function getName() {
        return 'fd_unidadofertaturno_type';
    }

}