<?php

namespace Fd\EstablecimientoBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

//use Sonata\AdminBundle\Route\RouteCollection;


class EstablecimientoAdmin extends Admin {

    protected function configureListFields(ListMapper $mapper) {
        $mapper
                ->addIdentifier('nombre')
                ->addIdentifier('apodo')
                ->add('distrito_escolar')
                ->add('te')
                ->add('cue')
                ->add('url')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $mapper) {
        $mapper
                ->add('apodo')
                ->add('nombre')
        ;
    }

    protected function configureFormFields(FormMapper $mapper) {
        $mapper
                ->with('Datos básicos')
                ->add('nombre', null, array(
                    'attr' => array(
                        'size' => 200,
                    )
                ))
                ->add('apodo')
                ->add('cue')
                ->add('unidades_educativas')
                ->end()
                ->with('Contacto')
                ->add('url')
                ->add('email')
                ->end()
                ->with('Autoridad')
                ->add('cargo_autoridad')
                ->add('nombre_autoridad')
                ->add('autoridades_rectorado')
                ->end()
                ->with('Otros')
                ->add('edificio')
                ->add('tipo_establecimiento')
                ->add('codigo_previo_transferencia')
                ->add('numero')
                ->add('orden')
                ->add('descripcion')
                ->add('fecha_creacion')
                ->add('tiene_cooperadora')
                ->add('campo_deportes')
                ->add('sector')
                ->add('fecha_elecciones')
                ->add('fin_mandato')
                ->add('anio_inicio_nes')
                ->add('recursos')
                ->end()
                ->with('Documentación')
                ->add('fecha_presentacion_roi', null, array('label'=>'Fec.presentación ROI'))
                ->add('fecha_aprobacion_roi', null, array('label'=>'Fec.aprobación ROI'))
                ->add('fecha_presentacion_ram')
                ->add('fecha_aprobacion_ram')
                ->add('fecha_presentacion_rp')
                ->add('fecha_aprobacion_rp')
                ->end()
        ;
    }

//    protected function configureListFields(\Sonata\AdminBundle\Datagrid\ListMapper $list) {
//        $list
//                ->add('nombre', 'text', array(
//                    'template' => 'EstablecimientoBundle:CRUD:list_establecimiento.html.twig'
//                ))
//                ->add('cue')
//                ->add('apodo')
//                ->add('_action', 'actions', array(
//                    'actions' => array(
//                        'preview' => array('template' => 'EstablecmientoBundle:CRUD:list__action_preview.html.twig'),
//                        'validate' => array(),
//                        'delete' => array(),
//                    )
//        ));
//    }
//
//    protected function configureRoutes(RouteCollection $collection) {
//        $collection
//                ->add('validate', $this->getRouterIdParameter() . '/validate');
//        $collection->remove('edit');
//        $collection->remove('create');
//    }
//
}