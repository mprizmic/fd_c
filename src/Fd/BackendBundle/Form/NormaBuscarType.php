<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Event\DataEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\TablaBundle\Repository\TipoNormaRepository;

class NormaBuscarType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('numero', 'integer', array(
            'required' => false,
            'label' => 'Número',
        ));
        $builder->add('anio', 'integer', array(
            'required' => false,
            'label' => 'Año',
        ));
        $builder->add('tipo', 'entity', array(
            'required' => false,
            'label' => 'Tipo',
            'class' => 'TablaBundle:TipoNorma',
            'empty_value' => 'Seleccione...',
            'query_builder' => function(TipoNormaRepository $er) {
                return $er->qbTodosOrdenado();
            },
        ));
        $builder->addEventListener(FormEvents::POST_BIND, function(DataEvent $event) {
                    $form = $event->getForm();
                    $datos = $form->getData();
                    $nombre = $form->getName();
                    if (empty($datos['numero']) and empty($datos['anio']) and empty($datos['tipo']) ) {
                        $form->addError(new FormError('No puede dejar todos los campos vacíos'));
                    };
                }
        );
    }

//    public function setDefaultOptions(OptionsResolverInterface $resolver) {
//        $resolver->setDefaults(array(
//            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Carrera'
//        ));
//    }

    public function getName() {
        return 'norma_buscar_type';
    }

}