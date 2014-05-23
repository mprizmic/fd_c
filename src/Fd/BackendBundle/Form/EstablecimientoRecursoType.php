<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
//use Fd\EstablecimientoBundle\Repository\EstablecimientoRepository;

class EstablecimientoRecursoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('establecimiento', 'entity', array(
                    'class' => 'EstablecimientoBundle:Establecimiento',
                    'empty_value' => 'Seleccione...',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->qbAllOrdenado();
                    },
                ))
                ->add('recurso', 'entity', array(
                    'class' => 'TablaBundle:Recurso',
                    'property' => 'descripcion',
                ))
                ->add('cantidad')
                ->add('origen_hora')
                ->add('comentario', null, array(
                    'required'=>false,
                    'attr'=>array(
                        'class'=> 'input_talle_5',
                    ),
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\EstablecimientoRecurso'
        ));
    }

    public function getName() {
        return 'fd_establecimientobundle_establecimientorecursotype';
    }

}
