<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Carrera;
//use Fd\OfertaEducativaBundle\Entity\Orientacion;
use Fd\OfertaEducativaBundle\Form\UnaOrientacionType;
use Fd\OfertaEducativaBundle\Form\UnTituloType;
use Fd\OfertaEducativaBundle\Form\Extension\HelpTypeExtension;

class CarreraType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', NULL, array(
                    'help' => 'Nombre de la carrera',
                    'attr' => array(
                        'size' => 50,
                    )
                ))
                ->add('duracion', NULL, array(
                    'label' => 'Duración',
                    'help' => 'Debe expresarse en cuatrimestres',
                    'attr' => array(
                        'size' => 50,
                    ),
                ))
                ->add('formacion', NULL, array(
                    'label' => 'Formación',
                ))
                ->add('estado')
                ->add('anio_inicio', 'integer', array(
                    'label' => 'Año de inicio del dictado',
                    'required' => false,
                ))
                ->add('orientaciones', 'collection', array(
                    'type' => new UnaOrientacionType(),
                    'label' => 'Orientaciones',
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                    'prototype' => true,
                        )
                )
                ->add('titulos', 'collection', array(
                    'type' => new UnTituloType(),
                    'label' => 'Titulos',
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                    'prototype' => true,
                        )
                )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Carrera',
            'cascade_validation' => true,
        ));
    }

    public function getName() {
        return 'carrera_type';
    }

}
