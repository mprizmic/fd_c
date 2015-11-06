<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\BackendBundle\Form\Filter\PlantelEstablecimientoFilterType;
use Fd\BackendBundle\Form\PlantelEstablecimientoType;
//use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitador;
use Fd\EstablecimientoBundle\Model\PlantelEstablecimientoManager;

/**
 * @Route("/plantelestablecimiento")
 */
class PlantelEstablecimientoController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('EstablecimientoBundle:PlantelEstablecimiento');
    }

    /**
     * Busqueda de plantelestablecimiento por nombre y apellido.
     * 
     * @Route("/buscar", name="backend.plantelestablecimiento.buscar")
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
                $planteles = $this->generarDatosBusquedaPaginada($form);
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
                $planteles = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                $planteles = array();
            }
        };

        return $this->render('BackendBundle:PlantelEstablecimiento:buscar.html.twig', array(
                    'planteles' => $planteles,
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
        $filterBuilder = $this->getRepository()->qbAllOrdenado();
        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $planteles = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $planteles;
    }

    /**
     * Crea el formulario de busqueda 
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new PlantelEstablecimientoFilterType(
                $this->getCmbEstablecimientos(), $this->getCmbDependencia(), $this->getCmbCargo()
        ));

        if (!is_null($datos_sesion))
            $form->setData($datos_sesion);

        return $form;
    }

    public function getCmbEstablecimientos() {
        $resultado = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->acceptDatosAChoice(new DatosAChoiceVisitador());

        return $resultado;
    }
    public function getCmbDependencia(){
        return $this->getEm()
                ->getRepository('TablaBundle:Dependencia')
                ->acceptDatosAChoice(new DatosAChoiceVisitador());
    }
    public function getCmbCargo(){
        return $this->getEm()
                ->getRepository('TablaBundle:Cargo')
                ->acceptDatosAChoice(new DatosAChoiceVisitador());
    }

    /**
     *
     * @Route("/{id}/show", name="backend.plantelestablecimiento.show")
     * @Template("BackendBundle:OrganizacionInterna:show.html.twig")
     * @ParamConverter("entity", class="EstablecimientoBundle:OrganizacionInterna")
     */
    public function showAction($entity) {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Organizacion Interna entity.
     *
     * @Route("/new", name="backend.plantelestablecimiento.new")
     * @Template("BackendBundle:OrganizacionInterna:new.html.twig")
     */
    public function newAction() {
        $entity = OrganizacionInternaManager::crearVacio();

        $form = $this->createForm(new OrganizacionInternaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Organizacion Interna entity.
     *
     * @Route("/create", name="backend.plantelestablecimiento.create")
     * @Method("post")
     * @Template("BackendBundle:OrganizacionInterna:new.html.twig")
     */
    public function createAction(Request $request) {

        $respuesta = new Respuesta();

        $manager = $this->get('fd.establecimiento.plantelestablecimiento.manager');

        $entity = $manager::crearVacio();

        $form = $this->createForm(new OrganizacionInternaType(), $entity);

        $form->bindRequest($request);

        if ($form->isValid()) {

            $respuesta = $manager->crear($form->getData());

            $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            if ($respuesta->getCodigo() == 1) {

                return $this->redirect($this->generateUrl('backend.plantelestablecimiento.edit', array('id' => $entity->getId())));
            }
        }

        return $this->render("BackendBundle:OrganizacionInterna:new.html.twig", array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Organizacion Interna entity.
     *
     * @Route("/{id}/edit", name="backend.plantelestablecimiento.edit")
     * @ParamConverter("entity", class="EstablecimientoBundle:OrganizacionInterna")
     */
    public function editAction($entity) {

        $editForm = $this->createForm(new OrganizacionInternaType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('BackendBundle:OrganizacionInterna:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ))
        ;
    }

    /**
     * Edits an existing Organizacion Interna entity.
     *
     * @Route("/{id}/update", name="backend.plantelestablecimiento.update")
     * @ParamConverter("entity", class="EstablecimientoBundle:OrganizacionInterna")
     * @Method("post")
     */
    public function updateAction($entity) {

        $respuesta = new Respuesta();

        $editForm = $this->createForm(new OrganizacionInternaType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            $manager = $this->get('fd.establecimiento.plantelestablecimiento.manager');

            $respuesta = $manager->crear($editForm->getData());

            $tipo = $respuesta->getCodigo() == 1 ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            if ($respuesta->getCodigo() == 1) {

                return $this->redirect($this->generateUrl('backend.plantelestablecimiento.edit', array('id' => $entity->getId())));
            }
        }

        return $this->render("BackendBundle:OrganizacionInterna:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Organizacion Interna entity.
     *
     * @Route("/{id}/delete", name="backend.plantelestablecimiento.delete")
     * @ParamConverter("entity", class="EstablecimientoBundle:OrganizacionInterna")
     * @Method("post")
     */
    public function deleteAction($entity, Request $request) {

        $form = $this->createDeleteForm($entity->getId());

        $form->bindRequest($request);

        if ($form->isValid()) {

            $manager = $this->get('fd.establecimiento.plantelestablecimiento.manager');

            $respuesta = $manager->eliminar($entity);

            $tipo = $respuesta->getCodigo() == 1 ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            if ($respuesta->getCodigo() == 1) {

                return $this->redirect($this->generateUrl('backend.plantelestablecimiento.buscar'));
            }
        }

        return $this->redirect($this->generateUrl('backend.plantelestablecimiento.edit', array("id" => $entity->getId())));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
