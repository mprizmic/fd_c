<?php

namespace Fd\OfertaEducativaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Repository\CarreraRepository;

class TituloType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nombre', 'text', array(
                    'attr' => array(
                        'class' => 'input_talle_5',
                    ),
                ))
                ->add('carrera', 'entity', array(
                    'class' => 'OfertaEducativaBundle:Carrera',
                    'property' => 'identificacion',
                    'query_builder' => function (CarreraRepository $repository) {
            
                        $qb = $repository->qbAllOrdenado('nombre');

                        return $qb;
                    },
                ))
                ->add('estado')
                ->add('estado_validez')
                ->add('fecha_estado_validez')
                ->add('validez_desde')
                ->add('validez_hasta')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Titulo'
        ));
    }

    public function getName() {
        return 'fd_ofertaeducativabundle_titulotype';
    }

}
