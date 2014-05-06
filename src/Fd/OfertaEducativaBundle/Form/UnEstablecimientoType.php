<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

class UnEstablecimientoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('flag', 'checkbox', array(
            'required' => FALSE,
        ));
        $builder->add('nombre', 'text', array(
            'read_only' => TRUE,
            'attr'=>array('class'=>'como_grilla'),
        ));
        $builder->add('establecimiento_id', 'hidden');
    }

    public function getName() {
        return 'un_establecimiento_type';
    }

}