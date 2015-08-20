<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormError;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Repository\EdificioRepository;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

class EstablecimientoEdificioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $factory = $builder->getFormFactory();

        /*
         * si el rgistro ya está creado no se puede cambiar el cue_anexo
         */
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($factory) {

            $form = $event->getForm();
            $data = $event->getData();

            $optionsCueAnexo = array(
                'label' => 'Cue anexo',
                'required' => true,
            );

            if ($data->getId()) {
                //si el registro ya está creado no se pueden cambiar el cue anexo
                $optionsCueAnexo['disabled'] = true;
            };

            $form->add(
                    $factory->createNamed('cue_anexo', 'text', null, $optionsCueAnexo));
        });

        $builder
                ->add('nombre', null, array(
                    'label' => 'Nombre descriptivo',
                    'required' => TRUE,
                ))
                ->add('fecha_creacion')
                ->add('fecha_baja')
                ->add('te1', null, array(
                    'label' => 'TE más usado',
                ))
                ->add('te2', null, array(
                    'label' => 'otro TE',
                ))
                ->add('te3', null, array(
                    'label' => 'otro TE',
                ))
                ->add('email1', null, array(
                    'label' => 'Email principal',
                ))
                ->add('email2', null, array(
                    'label' => 'otro email',
                ))
                ->add('edificios', 'entity', array(
                    'class' => 'EdificioBundle:Edificio',
                    'query_builder' => function (EdificioRepository $repository) {
                        $qb = $repository->qbAllOrdenado();
                        return $qb;
                    },
                ))
        ;
        //se agrega establecimiento sólo si el registro ya existe.
        $factory = $builder->getFormFactory();

        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function(FormEvent $event) use($factory) {
            $data = $event->getData();
            $form = $event->getForm();
            if (!$data->getId()) {
                $form->add($factory->createNamed('establecimientos', 'entity', null, array(
                            'class' => 'Fd\EstablecimientoBundle\Entity\Establecimiento',
                            'empty_value' => 'Seleccione el establecimiento que usará el edificio ...',
                )));
            };
        }
        );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio'
        ));
    }

    public function getName() {
        return 'fd_establecimientoedificio_type';
    }

}
