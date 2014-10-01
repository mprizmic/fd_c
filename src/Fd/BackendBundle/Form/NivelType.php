<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NivelType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'attr' => array(
                        'size' => 3,
                    )
                ))
                ->add('abreviatura', 'text', array(
                    'attr' => array(
                        'size' => 3,
                    )
                ))
                ->add('orden', 'number', array(
                    'attr' => array(
                        'size' => 2,
                    )
                ))
                ->add('crearUOClass', 'text', array(
                    'attr' => array(
                        'size' => 50,
                    )
                ))
        ;
    }

    public function getName() {
        return 'fd_tablabundle_niveltype';
    }

}
