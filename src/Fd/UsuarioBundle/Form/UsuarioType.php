<?php

namespace Fd\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\UsuarioBundle\Entity\Usuario;

class UsuarioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre_usuario')
                ->add('nombre')
                ->add('apellido')
                ->add('email')
                ->add('rol')
                ->add('fecha_nacimiento', 'birthday', array(
                    'label' => 'Fecha de nacimiento (puede poner cualquier año)',
                    'required' => FALSE
                ))
                ->add('fecha_nacimiento', 'birthday', array(
                    'label' => 'Fecha de nacimiento',
                    'help'=>'Puede poner cualquier año o ninguno',
                    'required' => false,
                ));

        //se agrega password sólo si el registro ya existe.
        $factory = $builder->getFormFactory();

        $agregoContraseña = function($form) use ($factory) {
                    $form->add($factory->createNamed('password', 'repeated', null, array(
                                'type' => 'password',
                                'invalid_message' => 'Las dos contraseñas deben coincidir',
                                'options' => array('label' => 'Contraseña nueva'),
                                'required' => true,
                            )));
                };

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory, $agregoContraseña) {
                    $data = $event->getData();
                    $form = $event->getForm();

                    if ($data == null) {
                        return;
                    }

                    if ($data->getId()) {
                        //es la edición de un registro existente y no se edita el campo contraseña
                        return;
                    } else {
                        //estoy editando un registro nuevo
                        $agregoContraseña($form);
                    }
                }
        );

        $builder->addEventListener(
                FormEvents::PRE_BIND, function (FormEvent $event) use ($factory, $agregoContraseña) {
                    $form = $event->getForm();
                    $data = $event->getData();
                    if ($data == null) {
                        return;
                    };

                    // FALTA no esta claro como andan estos if
                    if ( array_key_exists('id', $data)) {
                        //es la edición de un registro existente y no se edita el campo contraseña
                        return;
                    } else {
                        //estoy editando un registro nuevo
                        $agregoContraseña($form);
                    };
                }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\UsuarioBundle\Entity\Usuario'
        ));
    }

    public function getName() {
        return 'usuariotype';
    }

}
