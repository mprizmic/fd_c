<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Fd\BackendBundle\Form\DisciplinaType;
use Fd\BackendBundle\Form\Filter\DisciplinaFilterType;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Disciplina;

/**
 * Disciplina controller.
 *
 * @Route("/disciplina")
 */
class DisciplinaController extends Controller {

    private $em;
    private $manager;

    public function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepo() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:Disciplina');
    }

    public function getManager() {
        if (!$this->manager) {
            $this->manager = new DisciplinaManager($this->getEm());
        };
        return $this->manager;
    }

    /**
     * @Route("/buscar", name="backend.disciplina.buscar")
     */
    public function buscarAction(Request $request) {

        $session = $this->get('session');
        $disciplinas = null;

        if ($request->getMethod() == 'POST') {

            //se diparó la búsqueda desde el formulario
            $form = $this->crearFormBusqueda();

            // bind values from the request
            $form->bindRequest($request);

            if ($form->isValid()) {

                //se guardan los datos en la sesiòn
                $datos = $form->getData();
                $session->set('datos', $datos);

                //se generan los resultados a partir de los parametros cargados en el form de busqueda
                $disciplinas = $this->generarDatosBusquedaPaginada($form);
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
                $disciplinas = $this->generarDatosBusquedaPaginada($form);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $form = $this->crearFormBusqueda();

                //debe ser null porque chequeo que se hace en el template
                $disciplinas = null;
            }
        };

        return $this->render('BackendBundle:Disciplina:buscar.html.twig', array(
                    'disciplinas' => $disciplinas,
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
        $filterBuilder = $this->getRepo()->qbAllOrdenado();

        // build the query from the given form object
        $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

        //crea el paginador
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $disciplinas = $paginador->paginate($filterBuilder->getQuery())
                ->getResult();

        return $disciplinas;
    }

    /**
     * Crea el formulario de busqueda de disciplinas.
     * Cuando se redespliega luego de avanzar una pàgina, se le recargan los datos originales que se guardaron 
     * previamente en la sesion.
     * 
     * @param type $datos_sesion
     * @return type 
     */
    public function crearFormBusqueda($datos_sesion = null) {

        $form = $this->createForm(new DisciplinaFilterType());

        if ($datos_sesion)
            $form->setData($datos_sesion);

        return $form;
    }

    /**
     * Finds and displays a Disciplina entity.
     *
     * @Route("/{id}/show", name="backend.disciplina.show")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Disciplina")
     * @Template()
     */
    public function showAction($entity) {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Disciplina entity.
     * 
     * @Route("/new", name="backend.disciplina.new")
     * @Template()
     */
    public function newAction() {

        $entity = new Disciplina();

        $form = $this->createForm(new DisciplinaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Disciplina entity.
     *
     * @Route("/create", name="backend.disciplina.create")
     * @Method("post")
     */
    public function createAction() {

        $respuesta = new Respuesta();

        $entity = new Disciplina();

        $request = $this->getRequest();
        $form = $this->createForm(new DisciplinaType(), $entity);

        $form->bindRequest($request);

        if ($form->isValid()) {

            $respuesta = $this->getManager()->crear($entity);

            if ($respuesta->getCodigo() == 1) {

                $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());

                return $this->redirect($this->generateUrl('backend.disciplina.edit', array(
                                    'id' => $respuesta->getObjNuevo()->getId(),
                )));
            }
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas con el formulario. Verifique y reintente.');

        return $this->render('BackendBundle:Disciplina:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Disciplina entity.
     *
     * @Route("/{id}/edit", name="backend.disciplina.edit")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Disciplina")
     * @Template()
     */
    public function editAction($entity) {

        $editForm = $this->createForm(new DisciplinaType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Disciplina entity.
     *
     * @Route("/{id}/update", name="backend.disciplina.update")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Disciplina")
     * @Method("post")
     * 
     */
    public function updateAction($entity, Request $request) {

        $respuesta = new Respuesta();
        $tipo = 'error';

        $editForm = $this->createForm(new DisciplinaType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            $manager = $this->get('fd.ofertaeducativa.disciplina.manager');

            $respuesta = $manager->crear($editForm->getData());

            $tipo = $respuesta->getCodigo() == 1 ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend.disciplina.edit', array('id' => $entity->getId())));
        }

        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        return $this->render('BackendBundle:Disciplina:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Disciplina entity.
     *
     * @Route("/{id}/delete", name="backend.disciplina.delete")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Disciplina")
     * @Method("post")
     */
    public function deleteAction($entity, Request $request) {

        $respuesta = new Respuesta();
        
        $tipo = 'error';

        $form = $this->createDeleteForm($entity->getId());

        $form->bindRequest($request);

        if ($form->isValid()) {

            $manager = $this->get('fd.ofertaeducativa.disciplina.manager');

            $respuesta = $manager->eliminar($entity);

            $tipo = $respuesta->getCodigo() == 1 ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend.disciplina.buscar', array('id' => $entity->getId())));
        }

        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('backend.disciplina.edit', array('id' => $entity->getId())));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
