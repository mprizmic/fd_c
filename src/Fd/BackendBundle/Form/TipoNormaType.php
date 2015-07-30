<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TipoNormaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codigo', null, array(
                    'label' => 'Código',
                ))
                ->add('descripcion', null, array(
                    'label' => 'Descripción',
                ))
        ;
    }

    public function getName() {
        return 'fd_tablabundle_tiponormatype';
    }

}
