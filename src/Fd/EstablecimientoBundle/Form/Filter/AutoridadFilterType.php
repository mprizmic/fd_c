<?php

namespace Fd\EstablecimientoBundle\Form\Filter;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\Autoridad;

class AutoridadFilterType extends AbstractType {

    private $establecimientos;
    private $cargos;

    public function __construct($establecimientos = array(), $cargos = array()) {

        $this->establecimientos = $establecimientos;
        $this->cargos = $cargos;
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
            'apply_filter'=>function(){},
        ));
        $builder->add('cargo', 'filter_choice', array(
            'label' => 'Cargos',
            'choices' => $this->cargos,
            'empty_value' => 'Seleccione...',
            'attr' => array(
                'class' => 'input_talle_4',
            ),
            'apply_filter'=>function(){},
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
