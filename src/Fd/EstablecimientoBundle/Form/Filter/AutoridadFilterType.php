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
            'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                if (empty($values['value'])) {
                    return null;
                };

                $query = $filterQuery->getQueryBuilder();

                // creo la nueva condicion
                $args[0] = $query->expr()->eq('oi.establecimiento', ':a_establecimiento');

                //va a testear si ya hay alguna condicion where 
                $where = $query->getDQLPart('where');

                if (!is_null($where)){

                    //ya existe condicion where así que la une con esta condicion where
                    array_unshift($args, $where);

                    //convierte el array en un objeto condicion andx
                    $where = new Expr\Andx($args);
                }else{
                    $where = $args[0];
                };

                //le agrega el where al querybuilder
                $query->add('where', $where);

                $query->setParameter('a_establecimiento', $values['value']);
            },
        ));
        $builder->add('cargo', 'filter_choice', array(
            'label' => 'Cargos',
            'choices' => $this->cargos,
            'empty_value' => 'Seleccione...',
            'attr' => array(
                'class' => 'input_talle_4',
            ),
            'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                if (empty($values['value'])) {
                    return null;
                };

                $query = $filterQuery->getQueryBuilder();

                // creo la nueva condicion
                $args[0] = $query->expr()->eq('pe.cargo', ':a_cargo');

                //va a testear si ya hay alguna condicion where 
                $where = $query->getDQLPart('where');

                if (!is_null($where)){

                    //ya existe condicion where así que la une con esta condicion where
                    array_unshift($args, $where);

                    //convierte el array en un objeto condicion andx
                    $where = new Expr\Andx($args);
                }else{
                    $where = $args[0];
                };

                //le agrega el where al querybuilder
                $query->add('where', $where);

                $query->setParameter('a_cargo', $values['value']);
            },
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
