<?php

namespace Fd\BackendBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;

class PlantelEstablecimientoFilterType extends AbstractType {

    private $establecimientos;

    public function __construct($establecimientos = array(), $dependencias = array(), $cargos = array()) {
        $this->establecimientos = $establecimientos;
        $this->dependencias = $dependencias;
        $this->cargos = $cargos;
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
                ->add('dependencia', 'filter_choice', array(
                    'label' => 'Dependencias',
                    'choices' => $this->dependencias,
                    'empty_value' => 'Seleccione...',
                    'attr' => array(
                        'class' => 'input_talle_4',
                    ),
                ))
                ->add('cargo', 'filter_choice', array(
                    'label' => 'Cargos',
                    'choices' => $this->cargos,
                    'empty_value' => 'Seleccione...',
                    'attr' => array(
                        'class' => 'input_talle_4',
                    ),
                ))
        ;
    }

    public function getName() {
        return 'plantelestablecimiento_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }

}
