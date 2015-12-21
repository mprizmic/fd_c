<?php

namespace Fd\BackendBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;

use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class PlantelEstablecimientoFilterType extends AbstractType {

    private $establecimientos;
    private $dependencias;
    private $cargos;

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
                    'apply_filter' => function (QueryInterface $filterQuery, $field, $values) {
                            if (empty($values['value'])) {
                                return null;
                            };
                            
                            $query = $filterQuery->getQueryBuilder();
                            $query->add('where', $query->expr()->eq('oi.establecimiento',':pe_establecimiento'));
                            $query->setParameter('pe_establecimiento', $values['value']);
  
                        },
                ))
                ->add('dependencia', 'filter_choice', array(
                    'label' => 'Dependencias',
                    'choices' => $this->dependencias,
                    'empty_value' => 'Seleccione...',
                    'attr' => array(
                        'class' => 'input_talle_4',
                    ),
                    'apply_filter'=>function(QueryInterface $filterQuery, $field, $values) {
                            if (empty($values['value'])) {
                                return null;
                            };
                            
                            $query = $filterQuery->getQueryBuilder();
                            
                            // $query->add('where', $query->expr()->eq('oi.dependencia', ':pe_dependencia'));
                            $args[0] = $query->expr()->eq('oi.dependencia', ':pe_dependencia');
                            
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
                            
                            $query->setParameter('pe_dependencia', $values['value']);
                            
                        },
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
