<?php

namespace Fd\EstablecimientoBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\Autoridad;

class AutoridadFilterType extends AbstractType {

    private $establecimientos;

    public function __construct($establecimientos = array()) {
        $this->establecimientos = $establecimientos;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('apellido', 'filter_text', array(
            'attr' => array(
                'class' => 'input_talle_4',
            )
        ));
        $builder->add('nombre', 'filter_text', array(
            'condition_pattern' => 4,
            'attr' => array(
                'class' => 'input_talle_4',
            ),
        ));
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
        return 'autoridad_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
        //para probar
//        $resolver->setDefaults(array(
//            "color" => "#0000FF"
//        ));        
    }

}