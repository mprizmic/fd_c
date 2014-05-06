<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Orientacion;

class UnaOrientacionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'textarea', array(
                    'label' => ' ',
                    'required' => FALSE,
                    'attr' => array(
                        'cols' => 40,
                        'ancho' => 18,
                        'descripcion'=>'Nombre',
                    )
                ))
                ->add('titulo', 'textarea', array(
                    'label' => ' ',
                    'required' => FALSE,
                    'attr' => array(
                        'cols' => 40,
                        'ancho' => 18,
                        'descripcion'=>'Título',
                    )
                ))
                ->add('duracion', 'textarea', array(
                    'label' => ' ',
                    'required' => FALSE,
                    'attr' => array(
                        'cols' => 10,
                        'ancho' => 5,
                        'descripcion'=>'Duración',
                    ),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Orientacion',
        ));
    }

    public function getName() {
        return 'una_orientacion_type';
    }

}