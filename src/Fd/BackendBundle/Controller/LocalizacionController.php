<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\BackendBundle\Form\LocalizacionType;
use Fd\EdificioBundle\Form\Type\DomiciliosType;
use Fd\EdificioBundle\Form\Type\UnDomicilioType;
use Fd\EstablecimientoBundle\Entity\Respuesta;

/**
 * Localizacion controller.
 *
 * @Route("/localizacion")
 */
class LocalizacionController extends Controller {

    private $em;

    /**
     * devuelve el EntityManager
     */
    public function getEm() {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * @Route("/determinar_principal/{localizacion_id}", name="backend_determinar_principal")
     */
    public function determinar_principalAction(Request $request, $localizacion_id) {

        $entity = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->find($localizacion_id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localizacion entity.');
        }

        $domicilios = $entity->getDomicilio();

        foreach ($domicilios as $key => $domicilio_localizacion) {

            $formularios[$key] = $this->createDeterminarForm($domicilio_localizacion)->createView();
        }

        return $this->render('BackendBundle:Localizacion:determinar_principal.html.twig', array(
                    'formularios' => $formularios,
                    'entity' => $entity,
                ));
    }

    /**
     * Recibe un id de domicilio_localizacion. Verifica si lo puede hacer predeterminado, y si puede lo hace.
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param type $domicilio_localizacion_id
     * 
     * @Route("/establecer_predeterminado/{domicilio_localizacion_id}", name="backend_establecer_predeterminado")
     */
    public function establecer_predeterminadoAction(Request $request, $domicilio_localizacion_id) {
        $repo_dl = $this->getEm()->getRepository('EdificioBundle:DomicilioLocalizacion');

        $domicilio_localizacion = $repo_dl->find($domicilio_localizacion_id);

        if (!$domicilio_localizacion) {
            throw $this->createNotFoundException();
        };

        $el_predeterminado = $repo_dl->hasOtroDomicilioPredeterminado($domicilio_localizacion);

        if ($el_predeterminado) {
            //existe un predeterminado y hay que hacerlo no predeterminado
            //luego hacer el informado como predeterminado
            $repo_dl->cancelarPredeterminado($el_predeterminado);
            $repo_dl->establecerPredeterminado($domicilio_localizacion);
        } else {
            //no existe un predeterminado. Éste objeto se hacer predeterminado
            $repo_dl->establecerPredeterminado($domicilio_localizacion);
        };
        return $this->redirect($this->generateUrl('backend_localizacion_edit', array('id' => $domicilio_localizacion->getLocalizacion()->getId())));
    }

    public function createDeterminarForm($domicilio_localizacion) {
        $principal = ( $domicilio_localizacion->getPrincipal() ? 'SI' : 'NO');
        $domicilio = $domicilio_localizacion->getDomicilio()->getCompleto();
        return $this->createFormBuilder(array(
                            'id' => $domicilio_localizacion->getId(),
                            'principal' => $principal,
                            'domicilio' => $domicilio,
                        ))
                        ->add('id', 'hidden')
                        ->add('principal', 'hidden')
                        ->add('domicilio', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * @Route("/", name="backend_localizacion")
     * @Template()
     */
    public function indexAction() {

        $establecimientos = $this->getEm()->getRepository('EstablecimientoBundle:Establecimiento')->findAllOrdenado('orden');

        $entities = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->findAll();

        return array(
            'establecimientos' => $establecimientos
        );
    }

    /**
     * @Route("/listar/{establecimiento_id}", name="backend_localizacion_listar", options={"expose"=true})
     * @Template()
     */
    public function listarAction($establecimiento_id) {

        $establecimiento = $this->getEm()->getRepository('EstablecimientoBundle:Establecimiento')->find($establecimiento_id);

        $entities = $this->getEm()->getRepository("EstablecimientoBundle:Localizacion")->findDelEstablecimiento($establecimiento_id);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Localizacion entity.
     *
     * @Route("/{id}/show", name="backend_localizacion_show")
     * @Template()
     */
    public function showAction($id) {

        $entity = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localizacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Localizacion entity.
     *
     * @Route("/new", name="backend_localizacion_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Localizacion();
        $form = $this->createForm(new LocalizacionType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Localizacion entity.
     *
     * @Route("/create", name="backend_localizacion_create")
     * @Method("post")
     * @Template("BackendBundle:Localizacion:new.html.twig")
     */
    public function createAction() {
        $entity = new Localizacion();
        $request = $this->getRequest();
        $form = $this->createForm(new LocalizacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            return $this->redirect($this->generateUrl('backend_localizacion_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Localizacion entity.
     *
     * @Route("/{id}/edit", name="backend_localizacion_edit")
     * @Template()
     */
    public function editAction(Request $request, $id) {
        if ($request->getMethod() == "GET") {

            $entity = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Localizacion entity.');
            }

            $editForm = $this->createForm(new LocalizacionType(), $entity);
            $deleteForm = $this->createDeleteForm($id);
            $domiciliosForm = $this->createDomiciliosForm($entity);

            return array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
                'domicilios_form' => $domiciliosForm->createView(),
            );
        } else {
            
        }
    }

    /**
     * Crea el formulario de asignación de domicilios a una localización
     * 
     * Creación del formulacio de domicilios.
     * Se leen los domicilios del edificio, luego se crea el form vacío.
     * Se agregan los domicilios en el form vía una matriz
     * 
     * @return type
     */
    public function createDomiciliosForm($localizacion) {

        $xx = $localizacion->getEstablecimientoEdificio()->getEdificios();
        //leo los domicilios de la BD
        $domicilios_bd = $this->getEm()->getRepository('EdificioBundle:Edificio')->findDomicilios($localizacion->getEstablecimientoEdificio()->getEdificios());

        $domicilios = $this->formatearAsignarDomicilios($domicilios_bd, $localizacion);
        $form = $this->createForm(new DomiciliosType());
        $form->setData(array('domicilios' => $domicilios));

        return $form;
    }

    /**
     * Entra una lista de domicilios y sale una matriz con los campos necesarios para la página de asignación de DomicilioLocalizacion
     * 
     * @param type $domicilios
     * @param type $localizacion
     * @return boolean
     */
    public function formatearAsignarDomicilios($domicilios, $localizacion) {
        /**
         * primero armo la lista de todos los domicilios
         * Luego recupero los domicilios ya asignados a localizacion que se está tratando
         * Despues recorro el vector y marco los domicilios que ya están asignados a dicha localización.
         * Marco también el principal
         */
        $resultado = array();
        foreach ($domicilios as $key => $value) {
            //aca se están cargando objetos Domicilio que luego serán cotejados con objetos DomicilioLocalizacion
            $resultado[$key]['flag'] = false;
            $resultado[$key]['nombre'] = $value->getCompleto();
            $resultado[$key]['principal'] = false;
            $resultado[$key]['domicilio_id'] = $value->getId();
            $resultado[$key]['domicilio_localizacion_id'] = 0;
        };
        $asignados = $this->getEm()->getRepository('EdificioBundle:DomicilioLocalizacion')->findBy(array('localizacion' => $localizacion));
        if ($asignados) {
            foreach ($resultado as $key => $value) {
                foreach ($asignados as $asignado) {
                    if ($asignado->getDomicilio()->getId() == $resultado[$key]['domicilio_id']) {
                        //el domicilio tiene registro en domicilio_localizacion
                        $resultado[$key]['flag'] = true;
                        //asigno el id de domicilio_localizacion
                        $resultado[$key]['domicilio_localizacion_id'] = $asignado->getId();

                        if ($asignado->getPrincipal()) {
                            $resultado[$key]['nombre'] = $resultado[$key]['nombre'] . ' (Domicilio predeterminado)';
                            $resultado[$key]['principal'] = true;
                        };
                    };
                }
            }
        }
        return $resultado;
    }

    /**
     * Asigna/desasigna un domicilio a una localizacion
     * 
     * @Route("/asignar_domicilio/{id}", name="backend_localizacion_asignar_domicilio")
     * @Method("post")
     * 
     * @param type $id de localizacion
     * @return type
     */
    public function asignar_domicilioAction(Request $request, $id) {
        $repositorio = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion');

        $entity = $repositorio->find($id);

        //proceso la asignacion de domcilios de una localizacion
        $form = $this->createDomiciliosForm($entity);
        $form->bind($request);

        if ($form->isValid()) {
            //se marcó al menos un domicilio
            $respuesta = $repositorio->asignar_domicilios($entity, $form->getData());

            $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend_localizacion_edit', array('id' => $id)));
        };
        $this->get('session')->getFlashBag()->add('notice', 'Problemas en la asignación de domicilios');

        //si hay problemas renderiza la misma pagina; necesita los formularios
        $editForm = $this->createForm(new LocalizacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);


        return $this->render('BackendBundle:Localizacion:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'domicilios_form' => $form->createView(),
                ));
    }

    /**
     * Edits an existing Localizacion entity.
     *
     * @Route("/{id}/update", name="backend_localizacion_update")
     * @Method("post")
     * @Template("BackendBundle:Localizacion:edit.html.twig")
     */
    public function updateAction($id) {

        $entity = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Localizacion entity.');
        }

        $editForm = $this->createForm(new LocalizacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Se guardó la localización');

            return $this->redirect($this->generateUrl('backend_localizacion_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Localizacion entity.
     *
     * @Route("/{id}/delete", name="backend_localizacion_delete")
     */
    public function deleteAction($id) {
        $repositorio = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion');

        $entity = $repositorio->find($id);

        $establecimiento_edificio_id = $entity->getEstablecimientoEdificio()->getId();

        if (!$entity) {
            $this->get('session')->getFlashBag()->add('notice', 'No existe la localización');
            return new RedirectResponse($this->generateUrl('backend_localizacion'));
        }

        $respuesta = $repositorio->eliminar($id);

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->redirect($this->generateUrl('backend_establecimiento_edificio_edit', array('id' => $establecimiento_edificio_id)));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
