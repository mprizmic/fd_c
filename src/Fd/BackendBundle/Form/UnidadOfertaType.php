<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\EstablecimientoBundle\Form\Type\UnidadOfertaTurnoType;

class UnidadOfertaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('unidades')
                ->add('ofertas')
                ->add('turnos', 'collection', array(
                    'type' => new UnidadOfertaTurnoType(),
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                ))
        ;
    }

    public function getName() {
        return 'fd_establecimientobundle_unidadofertatype';
    }

}
