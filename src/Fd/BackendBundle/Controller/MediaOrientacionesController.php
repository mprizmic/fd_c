<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\BackendBundle\Form\Filter\MediaOrientacionesFilterType;
use Fd\BackendBundle\Form\MediaOrientacionesType;
use Fd\EstablecimientoBundle\Model\Constantes;
use Fd\OfertaEducativaBundle\Entity\MediaOrientaciones;

/**
 * Autoridad controller.
 *
 * @Route("/mediaorientaciones")
 */
class MediaOrientacionesController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:MediaOrientaciones');
    }

    /**
     * @Route("/buscar", name="backend.mediaorientaciones.buscar")
     * @ParamConverter()
     */
    public function buscarAction(Request $request) {

        $session = $this->get('session');

        if ($request->getMethod() == 'POST') {

            //se diparó la búsqueda desde el formulario
            $form = $this->crearFormBusqueda();

            // bind values from the request
            $form->bind($request);

            if ($form->isValid()) {

                //se guardan los datos en la sesiòn
                $datos = $form->getData();
                $session->set('datos', $datos);

                //se generan los resultados a partir de los parametros cargados en el form de busqueda
                $orientaciones = $this->generarDatosBusquedaPaginada($form);
            };
        };

        if ($request->getMethod() == 'GET') {

            //o bien se pidió la página o bien se pidió la paginación de los resultados
            //la paginacion manda un GET con la variable 'page'. Si no existe 'page' no fue un request de paginacion
            if ($request->query->get('page')) {
                //se pidió paginación
                //regenero el form para mostrarlo con los datos que le habìa cargado
                $datos = $session->get('datos');
                $form = $this->crearFormBusqueda($datos);

                //hay por lo menos un campo con algo
                $orientaciones = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                $orientaciones = array();
            }
        };

        return $this->render('BackendBundle:MediaOrientaciones:buscar.html.twig', array(
                    'orientaciones' => $orientaciones,
                    'form' => $form->createView(),
                        )
        );
    }

    /**
     * Genera un array que contiene los datos a ser mostrados en el template
     * Los genera a partir de los datos cargados en el form de busqueda usando el generador de filtro
     * y el paginador
     * 
     * @param type form
     * @return type array
     */
    public function generarDatosBusquedaPaginada($form) {
        //se crear la consulta
        $filterBuilder = $this->getRepository()->createQueryBuilder('m')->orderBy('m.orden');

        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage(Constantes::GRILLA_MEDIANO);

        //hay por lo menos un campo con algo
        $orientaciones = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $orientaciones;
    }

    /**
     * Crea el formulario de busqueda de orientaciones de la nes
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new MediaOrientacionesFilterType());

        if ($datos_sesion)
            $form->setData($datos_sesion);

        return $form;
    }

    /**
     * Finds and displays a Autoridad entity.
     *
     * @Route("/{id}/show", name="backend_autoridad_show")
     * @Template()
     */
//    public function showAction($id) {
//        $em = $this->getDoctrine()->getEntityManager();
//
//        $entity = $em->getRepository('EstablecimientoBundle:Autoridad')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Autoridad entity.');
//        }
//
//        $deleteForm = $this->createDeleteForm($id);
//
//        return array(
//            'entity' => $entity,
//            'delete_form' => $deleteForm->createView(),);
//    }

    /**
     * Displays a form to create a new Autoridad entity.
     *
     * @Route("/new", name="backend.mediaorientaciones.new")
     * @Template()
     */
    public function newAction() {
        $entity = new MediaOrientaciones();
        $form = $this->createForm(new MediaOrientacionesType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new orientacion entity.
     *
     * @Route("/create", name="backend.mediaorientaciones.create")
     * @Method("post")
     * @Template("BackendBundle:MediaOrientaciones:new.html.twig")
     */
    public function createAction() {
        $entity = new MediaOrientaciones();
        $request = $this->getRequest();
        $form = $this->createForm(new MediaOrientacionesType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('exito', 'La orientación fue creada exitosamente');

            return $this->redirect($this->generateUrl('backend.mediaorientaciones.edit', array('id' => $entity->getId())));
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas en el registro de la nueva orientación. Verifique y reintente');
        
        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing orientación entity.
     *
     * @Route("/{id}/edit", name="backend.mediaorientaciones.edit")
     * @ParamConverter("entity", class="OfertaEducativaBundle:MediaOrientaciones")
     */
    public function editAction($entity) {
        $editForm = $this->createForm(new MediaOrientacionesType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('BackendBundle:MediaOrientaciones:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ))
        ;
    }

    /**
     * Edits an existing orientación entity.
     *
     * @Route("/{id}/update", name="backend.mediaorientaciones.update")
     * @Method("post")
     * @Template("BackendBundle:MediaOrientaciones:edit.html.twig")
     * @ParamConverter("entity", class="OfertaEducativaBundle:MediaOrientaciones")
     */
    public function updateAction($entity) {

        $editForm = $this->createForm(new MediaOrientacionesType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            $this->get('session')->getFlashBag()->add('exito', 'La orientación fue cargada exitosamente');

            return $this->redirect($this->generateUrl('backend.mediaorientaciones.edit', array('id' => $entity->getId())));
        }

        $this->get('session')->getFlashBag()->add('aviso', 'Problemas al cargar la orientaciones. Verifique y reintente.');

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Autoridad entity.
     *
     * @Route("/{id}/delete", name="backend.mediaorientaciones.delete")
     * @Method("post")
     * @ParamConverter("entity", class="OfertaEducativaBundle:MediaOrientaciones")
     */
    public function deleteAction($entity) {
        $form = $this->createDeleteForm($entity->getId());
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {

            $this->getEm()->remove($entity);
            $this->getEm()->flush();
        }

        return $this->redirect($this->generateUrl('backend.mediaorientaciones.buscar'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
