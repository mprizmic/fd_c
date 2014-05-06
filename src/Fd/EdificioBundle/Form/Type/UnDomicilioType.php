<?php

namespace Fd\EdificioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EdificioBundle\Entity\DomicilioLocalizacion;

class UnDomicilioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('flag', 'checkbox', array(
            'required' => FALSE,
        ));
        $builder->add('nombre', 'text', array(
            'read_only' => TRUE,
            'attr'=>array('class'=>'como_grilla'),
        ));
        $builder->add('domicilio_id', 'hidden');
        $builder->add('domicilio_localizacion_id', 'hidden');
        $builder->add('principal', 'hidden');
    }

    public function getName() {
        return 'un_domicilio_type';
    }

}