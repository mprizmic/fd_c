<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\BackendBundle\Form\Filter\TituloFilterType;
use Fd\OfertaEducativaBundle\Entity\Titulo;
use Fd\OfertaEducativaBundle\Form\TituloType;

/**
 * Titulo controller.
 *
 * @Route("/titulo")
 */
class TituloController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:Titulo');
    }

    /**
     * Busqueda de titulo.
     * 
     * FALTA testear
     * 
     * @Route("/buscar", name="backend_titulo_buscar")
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
                $titulos = $this->generarDatosBusquedaPaginada($form);
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
                $titulos = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                $titulos = null;
            }
        };

        return $this->render('BackendBundle:Titulo:buscar.html.twig', array(
                    'titulos' => $titulos,
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
        $filterBuilder = $this->getRepositorio()->createQueryBuilder('t')->orderBy('t.nombre');

        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_largo'));

        //hay por lo menos un campo con algo
        $titulos = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $titulos;
    }

    /**
     * Crea el formulario de busqueda de titulo.
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new TituloFilterType());

        if ($datos_sesion)
            $form->setData($datos_sesion);

        return $form;
    }

    /**
     * Displays a form to create a new Titulo entity.
     *
     * @Route("/nuevo", name="backend_titulo_nuevo")
     * @Template()
     */
    public function nuevoAction() {
        $entity = new Titulo();
        $form = $this->createForm(new TituloType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Titulo entity.
     * 
     * FALTA testear
     *
     * @Route("/create", name="backend_titulo_create")
     * @Method("POST")
     * @Template("BackendBundle:Titulo:nuevo.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Titulo();
        $form = $this->createForm(new TituloType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_titulo_editar', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Titulo entity.
     *
     * @Route("/{id}/editar", name="backend_titulo_editar")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Titulo", options={"id"="titulo_id"})
     * @Template()
     */
    public function editarAction($entity) {
        $em = $this->getEm();

        $editForm = $this->createForm(new TituloType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Titulo entity.
     *
     * @Route("/{id}/update", name="backend_titulo_update")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Titulo", options={"id"="titulo_id"})
     * @Method("POST")
     * @Template("BackendBundle:Titulo:editar.html.twig")
     */
    public function updateAction(Request $request, $entity) {
        $deleteForm = $this->createDeleteForm($entity->getId());
        $editForm = $this->createForm(new TituloType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            return $this->redirect($this->generateUrl('backend_titulo_editar', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Titulo entity.
     *
     * @Route("/{id}/delete", name="backend_titulo_delete")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Titulo", options={"id"="titulo_id"})
     * @Method("POST")
     */
    public function deleteAction(Request $request, $entity) {
        $form = $this->createDeleteForm($entity->getId());
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_titulo_buscar'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}