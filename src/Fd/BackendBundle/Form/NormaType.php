<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\BackendBundle\Entity\TipoNorma;

class NormaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('numero', null, array(
                    'label' => 'Número',
                ))
                ->add('tipo_norma', null, array(
                    'label' => 'Tipo de norma',
                ))
                ->add('anio', null, array(
                    'label' => 'Año',
                ))
                ->add('descripcion', 'textarea', array(
                    'label' => 'Descripción',
                    'required'=>'false',
                    'attr' => array(
                        'cols' => 100,
                        'rows' => 6,
                    ),
                ))
        ;
    }

    public function getName() {
        return 'fd_OfertaEducativabundle_normatype';
    }

}
