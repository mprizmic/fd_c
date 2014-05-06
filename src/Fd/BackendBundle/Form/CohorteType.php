<?php

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Repository\EstablecimientoRepository;
use Fd\EstablecimientoBundle\Repository\UnidadEducativaRepository;
use Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\OfertaEducativaBundle\Entity\Cohorte;

class CohorteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('matricula', 'integer', array(
                    'label' => 'Matrícula:',
                ))
                ->add('matricula_ingresantes', 'integer', array(
                    'label' => 'Ingresantes:',
                ))
//                ->add('matricula_inicial', 'integer', array(
//                    'label' => 'Matrícula inicial',
//                    'required' => false,
//                ))
//                ->add('matricula_final', 'integer', array(
//                    'label' => 'Matrícula final',
//                    'required' => false,
//                ))
                ->add('egreso', 'integer', array(
                    'label' => 'Graduados a abril:',
                ))
        ;
        //se agrega anio y unidad_oferta sólo si el registro ya existe.
        $factory = $builder->getFormFactory();

        $refreshCarreras = function ($form, $establecimiento) use ($factory) {
                    $form->add($factory->createNamed('unidad_oferta', 'entity', null, array(
                                'class' => 'EstablecimientoBundle:UnidadOferta',
                                'label' => 'Carrera',
                                'property' => 'unidades',
                                'query_builder' => function (UnidadOfertaRepository $repository) use ($establecimiento) {

                                    if ($establecimiento instanceof UnidadEducativa) {
                                        $unidad_educativa_id = $establecimiento->getId();
                                    } elseif (is_numeric($establecimiento)) {
                                        $unidad_educativa_id = $establecimiento;
                                    } else {
                                        $unidad_educativa_id = 1;
                                        // FALTA reemplazar por otra cosa
                                    }
                                    $qb = $repository->qbCarrerasPorEstablecimiento($unidad_educativa_id);

                                    return $qb;
                                },
                            )));
                };


        $builder->addEventListener(
                FormEvents::PRE_SET_DATA, function(FormEvent $event) use ($refreshCarreras, $factory) {
                    $data = $event->getData();
                    $form = $event->getForm();

                    if ($data == null) {
                        return;
                    };

                    if (!$data->getId()) {
                        //combo de establecimientos
                        $form->add($factory->createNamed('cmb_establecimientos', 'entity', null, array(
                                    'mapped' => false,
                                    'class' => 'Fd\EstablecimientoBundle\Entity\UnidadEducativa',
                                    'property' => 'establecimiento',
                                    'label' => 'Establecimiento',
                                    'query_builder' => function (UnidadEducativaRepository $repository) {
                                        return $repository->qbLosTerciariosOrdenados();
                                    },
                                )));

                        if ($data instanceof Cohorte) {
                            $refreshCarreras($form, null);
                        };

                        //año de la matricula
                        $form->add($factory->createNamed('anio', 'integer', null, array(
                                    'label' => 'Año',
                                )));
                    };
                }
        );
        $builder->addEventListener(FormEvents::PRE_BIND, function (FormEvent $event) use ($refreshCarreras, $factory) {
                    $form = $event->getForm();
                    $data = $event->getData();

                    if (array_key_exists('cmb_establecimientos', $data)) {
                        $refreshCarreras($form, $data['cmb_establecimientos']);
                    }
                });
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Fd\OfertaEducativaBundle\Entity\Cohorte'
        ));
    }

    public function getName() {
        return 'fd_cohorte_type';
    }

}
