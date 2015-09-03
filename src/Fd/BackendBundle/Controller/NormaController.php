<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\OfertaEducativaBundle\Model\NormaManager;
use Fd\OfertaEducativaBundle\Repository\NormaRepository;
use Fd\BackendBundle\Form\NormaType;
use Fd\BackendBundle\Form\NormaBuscarType;
use Fd\BackendBundle\Form\Handler\NormaFormHandler;

/**
 * Norma controller.
 *
 * @Route("/norma")
 */
class NormaController extends Controller {

    private $em;
    private $repo;

    public function getRepo() {
        if (is_null($this->repo)) {
            $this->repo = $this->getDoctrine()->getEntityManager()->getRepository('OfertaEducativaBundle:Norma');
        };
        return $this->repo;
    }

    public function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * buscar una norma con filtros y obtener una grilla 
     * 
     * @Route("/norma_buscar", name="backend_norma_buscar")
     */
    public function buscarAction(Request $request) {

        if ($request->getMethod() == 'POST') {

            //se diparó la búsqueda desde el formulario
            $formulario = $this->createForm(new NormaBuscarType());

            $formulario->bind($request);

            if ($formulario->isValid()) {
                $datos = $formulario->getData();

                $this->get('session')->set('datos', $datos);
                //hago la consulta de normas para llenar la grilla pasando los datos del formalario de filtros
                $normas = $this->obtenerNormasPaginadas($datos);
            } else {
                $normas = array();
            }
        }
        if ($request->getMethod() == 'GET') {
            $formulario = $this->createForm(new NormaBuscarType());
            //o bien se pidió la página o bien se pidió la paginación de los resultados
            //la paginacion manda un GET con la variable 'page'. Si no existe 'page' no fue un request de paginacion
            if ($request->query->get('page')) {
                //se pidió paginación
                //asigno datos 
                $datos = $this->get('session')->get('datos');
                $formulario->setData($datos);
                $normas = $this->obtenerNormasPaginadas($datos);
            } else {
                //se entra a la página por primera vez
                //o bien se clickeo en 'limpiar'
                $normas = null;
            }
        }

        $content = $this->renderView('BackendBundle:Norma:buscar.html.twig', array(
            'formulario' => $formulario->createView(),
            'normas' => $normas,
        ));

        return new Response($content);
    }

    /**
     * obtiene las normas giltradas con la paginacion
     * @param type $datos
     * @return type
     */
    public function obtenerNormasPaginadas($datos) {
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_mediano'));

        //hay por lo menos un campo con algo
        $normas = $paginador->paginate(
                        $this->getRepo()->qyFiltradas($datos)
                )->getResult();
        return $normas;
    }

    public function obtenerNormas($datos) {
        $normas = $this->getRepo()
                ->qyFiltradas($datos)
                ->getResult();
        return $normas;
    }

    /**
     * @Route("/combo", name="norma_combo")
     */
    public function comboAction() {

        $normas = $this->getRepo()->findAllOrdenadoArray('numero');
        $datos = array("responseCode" => 200, "respuesta" => $normas);
        $response = new Response(json_encode($datos));
        $response->headers->set('content-type', 'application/json');
        return $response;
    }

    /**
     * Testeado
     * 
     * En la tabla resultado de la busqueda de norma, en la página de edit de norma,
     * hay una accion "seleccionar" para las normas de la tabla.
     * Esta accion agrega una norma ("norma a las que referencia esta norma") 
     * a la cual hace referencia la norma que se está editando.
     * Se genera la nueva referencia.
     * 
     * $entity_id es la norma desde la cual se dispara la accion, la que se está editando
     * $seleccion_id es la norma que se seleccionò ya sea para referencias o ser referenciada
     * $accion toma el valor referencia_a o es_referenciada
     * 
     * Se guarda el valor en la entity que hace de lado propietario de la relacion
     * 
     * luego se deriva a entity_id que es la norma que se estaba editando
     * 
     * @Route("/referenciar/{entity_id}/{seleccion_id}/{accion}", name="backend_norma_referenciar")
     */
    public function referenciarAction($entity_id, $seleccion_id, $accion) {

        $norma_editada = $this->getRepo()->find($entity_id);

        $norma_seleccionada = $this->getRepo()->find($seleccion_id);

        if (!$norma_editada) {
            throw $this->createNotFoundException('Unable to find Norma entity.');
        };

        $respuesta = new Respuesta();

        $norma_manager = new NormaManager($this->getEm());

        $respuesta = $norma_manager->referenciar($norma_editada, $norma_seleccionada, $accion);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('backend_norma_edit', array(
                            'id' => $norma_editada->getId(),
        )));
    }

    /**
     * Testeado
     * 
     * Displays a form to create a new Norma entity.
     *
     * @Route("/new", name="backend_norma_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Norma();
        $form = $this->createForm(new NormaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Testeado
     * 
     * Creates a new Norma entity.
     *
     * @Route("/create", name="backend_norma_crear")
     * @Method("post")
     * @Template("BackendBundle:Norma:new.html.twig")
     * @ParamConverter()
     */
    public function crearAction(Request $request) {
        $respuesta = new Respuesta();

        $entity = new Norma();

        $form = $this->createForm(new NormaType(), $entity);

        $formHandler = new NormaFormHandler(new NormaManager($this->getEm()));

        $respuesta = $formHandler->crear($form, $request);
        
        $aviso = ($respuesta->getCodigo()==1) ? 'exito':'error' ;

        $this->get('session')->getFlashBag()->add($aviso, $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {

            return $this->redirect($this->generateUrl('backend_norma_edit', array('id' => $respuesta->getClaveNueva())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Norma entity.
     *
     * @Route("/{id}/edit/{referencia}", name="backend_norma_edit", defaults={ "referencia" = "" } )
     * @ParamConverter("norma", class="OfertaEducativaBundle:Norma")
     * @Template()
     */
    public function editAction(Request $request, $norma, $referencia) {

        $editForm = $this->createForm(new NormaType(), $norma);
        $deleteForm = $this->createDeleteForm($norma->getId());

        $searchForm = $this->createSearchForm();
        $resultado_busqueda = array();

        if ($request->request->get($searchForm->getName())) {

            //viene de presionar BUSCAR
            $searchForm->bind($request);

            if ($searchForm->isValid()) {
                $datos = $searchForm->getData();

                $this->get('session')->set('datos', $datos);

                $resultado_busqueda = $this->obtenerNormas($datos);
            } else {
                $resultado_busqueda = array();
            }
        };

        return array(
            'entity' => $norma,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'search_form' => $searchForm->createView(),
            'accion' => 'actualizar',
            'titulo' => 'Editar norma',
            'display_referencia' => $referencia,
            'normas' => $resultado_busqueda,
        );
    }

    /**
     * Testeado
     * 
     * Edits an existing Norma entity.
     *
     * @Route("/{id}/update", name="backend_norma_update")
     * @Method("post")
     * @Template("BackendBundle:Norma:edit.html.twig")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Norma")
     */
    public function updateAction(Norma $entity, Request $request) {

        $editForm = $this->createForm(new NormaType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        $searchForm = $this->createSearchForm($entity->getId());

        $formHandler = new NormaFormHandler(new NormaManager($this->getEm()));

        $respuesta = $formHandler->actualizar($editForm, $request);

        $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';

        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('backend_norma_edit', array('id' => $entity->getId())));
        };

        $delete_form = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'search_form' => $searchForm->createView(),
            'accion' => 'actualizar',
            'titulo' => 'Editar norma',
        );
    }

    /**
     * Testeado. 
     * FALTA probar que elimine las referencias
     * 
     * Deletes a Norma entity.
     *
     * @Route("/{id}/delete", name="backend_norma_delete")
     * @Method("post")
     * @ParamConverter("entity", class="OfertaEducativaBundle:Norma")
     */
    public function deleteAction(Norma $entity, Request $request) {

        $respuesta = new Respuesta();

        $form = $this->createDeleteForm($entity->getId());

        $formHandler = new NormaFormHandler(new NormaManager($this->getEm()));

        $respuesta = $formHandler->eliminar($form, $request, $entity); //la entity la paso para no tener que ir a buscar de nuevo despues
        
        $aviso = ($respuesta->getCodigo()==1) ? 'exito':'error' ;

        $this->get('session')->getFlashBag()->add($aviso, $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('backend_norma_buscar'));
    }

    /**
     * testeado
     * 
     * Deletes a Norma entity.
     * @Route("/{norma_id}/{referencia_id}/{entity_volver_id}/delete", name="backend_norma_delete_referencia")
     * @Method("get")
     * 
     * No me anduvo el ParamConverter
     */
    public function deleteReferenciaAction(Norma $norma_id, Norma $referencia_id, Norma $entity_volver_id, Request $request) {

        $norma_editada = $this->getEm()->getRepository('OfertaEducativaBundle:Norma')->find($entity_volver_id);

        $norma_apuntadora = $this->getEm()->getRepository('OfertaEducativaBundle:Norma')->find($norma_id);

        $norma_apuntada = $this->getEm()->getRepository('OfertaEducativaBundle:Norma')->find($referencia_id);

        if (!$norma_editada or ! $norma_apuntada or ! $norma_apuntadora) {
            throw $this->createNotFoundException('Unable to find Norma entity.');
        };

        $respuesta = new Respuesta();

        $norma_manager = new NormaManager($this->getEm());

        $respuesta = $norma_manager->eliminar_referencia($norma_apuntadora, $norma_apuntada, $norma_editada, $request);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        if ($respuesta->getCodigo() == 1) {
            return $this->redirect($this->generateUrl('backend_norma_edit', array(
                                'id' => $norma_editada->getId(),
            )));
        };

        $editForm = $this->createForm(new NormaType(), $norma_editada);

        $deleteForm = $this->createDeleteForm($norma_editada->getId());

        $searchForm = $this->createSearchForm($norma_editada->getId());

        return array(
            'entity' => $norma_editada,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'search_form' => $searchForm->createView(),
            'accion' => 'actualizar',
            'titulo' => 'Editar norma',
        );











        try {
            $norma->removeReferenciaA($referencia);
            $this->getEm()->persist($norma);
            $this->getEm()->flush();
        } catch (Exception $e) {
            throw $this->createNotFoundException('No se pudo borrar la referencia.');
        };

        return $this->render('BackendBundle:Norma:edit.html.twig', array(
                    'entity' => $entity_volver,
                    'edit_form' => $this->createForm(new NormaType(), $norma)->createView(),
                    'delete_form' => $this->createDeleteForm($norma->getId())->createView(),
                    'accion' => 'actualizar',
                    'titulo' => 'Editar norma',
        ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    private function createSearchForm() {
        return $this->createForm(new NormaBuscarType());
    }

}
