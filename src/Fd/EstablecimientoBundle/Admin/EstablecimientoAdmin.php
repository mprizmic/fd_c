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
                ->add('nombre')
                ->add('apodo')
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
//    protected function configurateDatagridFilters(DatagridMapper $datagridMapper) {
//        $datagridMapper->add('nombre')
//                ->add('cue')
//                ->add('apodo');
//    }
}