<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Entity\Turno;
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
        ;
    }

    public function getName() {
        return 'fd_tablabundle_cargotype';
    }

}
