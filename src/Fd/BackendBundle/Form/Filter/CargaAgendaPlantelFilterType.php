<?php

namespace Fd\BackendBundle\Form\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query\Expr;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class CargaAgendaPlantelFilterType extends AbstractType {

    private $establecimientos;

    public function __construct($establecimientos = array()) {
        $this->establecimientos = $establecimientos;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('establecimiento', 'filter_choice', array(
            'required' => true,
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
                $query->add('where', $query->expr()->eq('oi.establecimiento', ':pe_establecimiento'));
                $query->setParameter('pe_establecimiento', $values['value']);
            },
        )
        );
    }

    public function getName() {
        return 'cargaagendaplantel_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }

}
