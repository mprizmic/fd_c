<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\TablaBundle\Entity\Dependencia;
use Fd\TablaBundle\Entity\Nivel;
use Fd\TablaBundle\Entity\Turno;
use Fd\TablaBundle\Repository\DependenciaRepository;
use Fd\TablaBundle\Repository\NivelRepository;
use Fd\TablaBundle\Repository\TurnoRepository;

class DependenciaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        $builder
                ->add('nombre', 'text', array('trim' => true))
                ->add('codigo', 'text', array(
                    'trim' => true,
                    'label' => 'Código',
                ))
                ->add('orden', 'number')
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
        return 'fd_backendbundle_dependenciatype';
    }

    public function getDefaultOptions(array $options) {
        return array('data_class' => 'Fd\TablaBundle\Entity\Dependencia',
        );
    }

}
