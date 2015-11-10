<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\BackendBundle\Form\AutoridadType;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Form\Filter\AutoridadFilterType;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitador;
use Fd\TablaBundle\Entity\Cargo;

/**
 * Autoridad controller.
 *
 * @Route("/autoridad")
 */
class AutoridadController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('EstablecimientoBundle:Autoridad');
    }

    /**
     * Busqueda de autoridad por nombre y apellido.
     * 
     * @Route("/buscar", name="backend.autoridad.buscar")
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
                $autoridades = $this->generarDatosBusquedaPaginada($form);
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
                $autoridades = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                $autoridades = array();
            }
        };

        return $this->render('BackendBundle:Autoridad:buscar.html.twig', array(
                    'autoridades' => $autoridades,
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
        $filterBuilder = $this->getRepository()->createQueryBuilder('a')->orderBy('a.apellido');

        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $autoridades = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $autoridades;
    }

    /**
     * Crea el formulario de busqueda de autoridades.
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new AutoridadFilterType(
                $this->getCmbEstablecimientos(), $this->getCmbCargos()
        ));

        if ($datos_sesion)
            $form->setData($datos_sesion);

        return $form;
    }

    public function getCmbEstablecimientos() {
        $resultado = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->acceptDatosAChoice(new DatosAChoiceVisitador());

        return $resultado;
    }

    public function getCmbCargos() {
        return $this->getEm()
                        ->getRepository('TablaBundle:Cargo')
                        ->acceptDatosAChoice(new DatosAChoiceVisitador());
    }

    /**
     * Finds and displays a Autoridad entity.
     *
     * @Route("/{id}/show", name="backend.autoridad.show")
     * @ParamConverter("entity", class="EstablecimientoBundle:Autoridad")
     */
    public function showAction($entity, Request $request) {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('EstablecimientoBundle:Autoridad:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to create a new Autoridad entity.
     *
     * @Route("/new", name="backend.autoridad.new")
     */
    public function newAction() {
        $entity = new Autoridad();
        $form = $this->createForm(new AutoridadType(), $entity);

        return $this->render('EstablecimientoBundle:Autoridad:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }
/**
 * HASTA ACA
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 * *************************************************************
 */
    /**
     * Creates a new Autoridad entity.
     *
     * @Route("/create", name="backend.autoridad.create")
     * @Method("post")
     * @Template("EstablecimientoBundle:Autoridad:new.html.twig")
     */
    public function createAction() {
        $entity = new Autoridad();
        $request = $this->getRequest();
        $form = $this->createForm(new AutoridadType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', 'La autoridad fue creada exitosamente');

            return $this->redirect($this->generateUrl('backend.autoridad.edit', array('id' => $entity->getId())));
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas en el registro de la nueva autoridad. Verifique y reintente');

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Autoridad entity.
     *
     * @Route("/{id}/edit", name="backend.autoridad.edit")
     * @ParamConverter("entity", class="EstablecimientoBundle:Autoridad")
     */
    public function editAction($entity) {
        $editForm = $this->createForm(new AutoridadType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('BackendBundle:Autoridad:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ))
        ;
    }

    /**
     * Edits an existing Autoridad entity.
     *
     * @Route("/{id}/update", name="backend.autoridad.update")
     * @Method("post")
     * @Template("BackendBundle:Autoridad:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EstablecimientoBundle:Autoridad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Autoridad entity.');
        }

        $editForm = $this->createForm(new AutoridadType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('exito', 'La autoridad fue cargada exitosamente');

            return $this->redirect($this->generateUrl('backend.autoridad.edit', array('id' => $id)));
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas al cargar la autoridad. Verifique y reintente.');

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Autoridad entity.
     *
     * @Route("/{id}/delete", name="backend.autoridad.delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EstablecimientoBundle:Autoridad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Autoridad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend.autoridad.buscar'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
