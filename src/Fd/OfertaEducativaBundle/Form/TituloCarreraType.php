<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Repository\CarreraRepository;
use Fd\TablaBundle\Entity\EstadoCarrera;
use Fd\TablaBundle\Repository\EstadoCarreraRepository;

class TituloCarreraType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_5',
                    ),
                ))
//                ->add('carrera', 'entity', array(
//                    'class' => 'OfertaEducativaBundle:Carrera',
//                    'property' => 'identificacion',
//                    'query_builder' => function (CarreraRepository $repository) {
//            
//                        $qb = $repository->qbAllOrdenado('nombre');
//
//                        return $qb;
//                    },
//                ))
                ->add('estado', 'entity', array(
                    'class' => 'TablaBundle:EstadoCarrera',
                    'label' => 'Estado del título',
                ))
//                ->add('estado', 'entity', array(
//                    'query_builder' => function (EstadoCarreraRepository $repository) {
//                        $qb = $repository->qbAll();
//                        return $qb;
//                    }
//                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\TituloCarrera'
        ));
    }

    public function getName() {
        return 'fd_ofertaeducativabundle_titulocarreratype';
    }

}
