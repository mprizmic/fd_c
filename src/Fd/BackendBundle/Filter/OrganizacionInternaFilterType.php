<?php

namespace Fd\BackendBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;

class OrganizacionInternaFilterType extends AbstractType {

    private $establecimientos;

    public function __construct($establecimientos = array()) {
        $this->establecimientos = $establecimientos;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('establecimiento', 'filter_choice', array(
            'label' => 'Establecimiento',
            'choices' => $this->establecimientos,
            'empty_value' => 'Seleccione...',
            'attr' => array(
                'class' => 'input_talle_4',
            ),
        ))
        ;
    }

    public function getName() {
        return 'organizacioninterna_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
      
    }

}