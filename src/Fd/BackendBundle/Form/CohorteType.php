<?php

/**
 * si la cohorte existe se cargan sólo los datos numéricos.
 * Si la cohorte no existe y se va a crear una nueva, se muestra un combo de sedes y anexos donde se 
 * dista el terciario, y otro combo con las carreras correspondientes. Además se carga el año
 */

namespace Fd\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Fd\EstablecimientoBundle\Repository\EstablecimientoRepository;
use Fd\EstablecimientoBundle\Repository\LocalizacionRepository;
//use Fd\EstablecimientoBundle\Repository\UnidadEducativaRepository;
use Fd\EstablecimientoBundle\Repository\UnidadOfertaRepository;
//use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Localizacion;
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
                ->add('egreso', 'integer', array(
                    'label' => 'Graduados a abril:',
                ))
        ;
        //se agrega anio y unidad_oferta sólo si el registro ya existe.
        $factory = $builder->getFormFactory();

        $refreshCarreras = function ($form, $localizacion) use ($factory) {

            $form->add($factory->createNamed('unidad_oferta', 'entity', null, array(
                        'class' => 'EstablecimientoBundle:UnidadOferta',
                        'label' => 'Carrera',
//                        'property' => 'localizacion',
                        'query_builder' => function (UnidadOfertaRepository $repository) use ($localizacion) {

                            if ($localizacion instanceof Localizacion) {
                                $localizacion_id = $localizacion->getId();
                            } elseif (is_numeric($localizacion)) {
                                $localizacion_id = $localizacion;
                            } else {
                                $localizacion_id = 88;
                                // FALTA reemplazar por otra cosa
                            };

                            $qb = $repository->qbUnidadOferta($localizacion);

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
                            'class' => 'Fd\EstablecimientoBundle\Entity\Localizacion',
                            'property' => 'establecimientoEdificio',
                            'label' => 'Sede/anexo',
                            'query_builder' => function (LocalizacionRepository $repository) {
                                return $repository->qbTerciariosCompleto();
                            },
                )));

                if ($data instanceof Cohorte) {
//                            $dato = $form['cmb_establecimientos'];
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
