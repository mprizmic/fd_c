<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Repository\PlantelEstablecimientoRepository;

class AutoridadType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'required' => false,
                ))
                ->add('apellido')
                ->add('cargo', 'entity', array(
                    'label' => 'Cargo',
                    'empty_value' => 'Seleccione...',
                    'class' => 'EstablecimientoBundle:PlantelEstablecimiento',
                    'query_builder' => function (PlantelEstablecimientoRepository $repository) {
                        $qb = $repository->qbAllOrdenado();
                        return $qb;
                    },                    
                ))
//                ->add('establecimiento')
                ->add('inicio_mandato', 'date', array(
                    'label' => 'Fecha de inicio del mandato',
                    'required' => false,
                ))
                ->add('te_particular', 'text', array(
                    'required' => false,
                ))
                ->add('celular', 'text', array(
                    'required' => false,
                ))
                ->add('email', 'email', array(
                    'required' => false,
                    'attr' => array('class' => 'input_talle_4'),
                    'help' => 'Un email válido',
                ))
        ;
    }

    public function getName() {
        return 'autoridad_type';
    }

}
