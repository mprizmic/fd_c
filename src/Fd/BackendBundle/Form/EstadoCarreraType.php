<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EstadoCarreraType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('codigo', null, array(
                    'label' => 'Código',
                ))
                ->add('descripcion', null, array(
                    'label' => 'Descripción',
                ))
                ->add('orden')
                ->add('comentario', 'textarea', array(
                    'required' => false,
                    'attr' => array(
                        'cols' => 50,
                        'rows' => 5,
                    ),
                ))
        ;
    }

    public function getName() {
        return 'fd_tablabundle_estadocarreratype';
    }

}
