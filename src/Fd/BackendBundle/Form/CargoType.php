<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Entity\Turno;
use Fd\TablaBundle\Repository\DependenciaRepository;
use Fd\TablaBundle\Repository\NivelRepository;
use Fd\TablaBundle\Repository\TurnoRepository;

class CargoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre')
                ->add('codigo')
                ->add('turno', 'entity', array(
                    'class' => 'TablaBundle:Turno',
                    'empty_value' => 'Seleccione un turno ...',
                    'required' => false,
                    'query_builder' => function (TurnoRepository $repository) {
                        return $repository->qbOrdenado();
                        createQueryBuilder('t');
                    },
                ))
                ->add('nivel', 'entity', array(
                    'class' => 'TablaBundle:Nivel',
                    'empty_value' => 'Seleccione un nivel ...',
                    'required' => false,
                    'property' => 'nombre',
                    'query_builder' => function (NivelRepository $repository) {
                        return $repository->qbOrdenado();
                    },
                ))
                ->add('dependencia_referenciante', 'entity', array(
                    'help' => 'Este campo tiene fines meramente informativos',
                    'class' => 'TablaBundle:Dependencia',
                    'empty_value' => 'Seleccione un nivel ...',
                    'required' => false,
                    'property' => 'nombre',
                    'query_builder' => function (DependenciaRepository $repository) {
                        return $repository->qbAllOrdenado();
                    },
                ))
                ->add('orden')
        ;
    }

    public function getName() {
        return 'fd_tablabundle_cargotype';
    }

}
