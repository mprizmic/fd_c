<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\BackendBundle\Form\UnEdificioType;

class InspectorType extends AbstractType {
    
    private $combo_edificios;
    public function __construct($combo_edificios) {
        $this->combo_edificios = $combo_edificios;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('apellido')
                ->add('email')
                ->add('te')
                ->add('combo_edificios', 'collection', array(
                    'type' => new UnEdificioType($this->combo_edificios),
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
                    'mapped'=>false,
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EdificioBundle\Entity\Inspector'
        ));
    }

    public function getName() {
        return 'fd_edificiobundle_inspectortype';
    }

}
