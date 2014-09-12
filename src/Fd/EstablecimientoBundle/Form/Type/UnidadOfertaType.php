<?php

namespace Fd\EstablecimientoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaTurnoType;

class UnidadOfertaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('turnos', 'collection', array(
                    'type' => new UnidadOfertaTurnoType(),
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\UnidadOferta',
        ));
    }

    public function getName() {
        return 'fd_unidadoferta_type';
    }

}
