<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Sala;
use Fd\OfertaEducativaBundle\Form\SalaType;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\TablaBundle\Entity\GrupoEtario;

class InicialXType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('matricula', 'integer', array(
                    'label' => 'Matrícula total:',
                    'attr' => array(
                        'class' => 'input_talle_05'
                    ),
                ))
                ->add('salas', 'collection', array(
                    'type' => new SalaType(),
                    'label' => ' ',
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                    'prototype' => TRUE,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\InicialX',
            'csrf_protection' => FALSE,
        ));
    }

    public function getName() {
        return 'inicial_x_type';
    }

}
