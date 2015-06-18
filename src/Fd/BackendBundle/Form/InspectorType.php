<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\BackendBundle\Form\UnEdificioType;

class InspectorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('apellido')
                ->add('email')
                ->add('te')
                ->add('edificios', 'collection', array(
                    'type' => new UnEdificioType(),
                    'by_reference' => FALSE,
                    'allow_delete' => TRUE,
                    'allow_add' => TRUE,
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
