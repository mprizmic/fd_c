<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EdificioBundle\Entity\Domicilio;
use Fd\EdificioBundle\Model\DomicilioManager;
use Fd\BackendBundle\Form\DomicilioType;
use Fd\EdificioBundle\Event\FilterEdificioEvent;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Symfony\Component\HttpFoundation\Request;

/**
 * Domicilio controller.
 *
 * @Route("/domicilio")
 */
class DomicilioController extends Controller {
    
    private $em;
    private $manager;
    
    public function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }
    private function getRepo() {
        return $this->getEm()->getRepository('EdificioBundle:Domicilio');
    }
    public function getManager() {
        if (!$this->manager) {
            $this->manager = new DomicilioManager($this->getEm());
        };
        return $this->manager;
    }    
    /**
     * Lists all Domicilio entities.
     *
     * @Route("/", name="backend_domicilio")
     * @Template()
     */
    public function indexAction() {

        $entities = $this->getEm()->getRepo()->findBy(array(), array('calle' => 'ASC'));

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Domicilio entity.
     *
     * @Route("/{id}/show", name="backend_domicilio_show")
     * @Template()
     */
    public function showAction($id) {

        $entity = $this->getRepo()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Domicilio entity.
     * 
     * Si el $edificio_id viene informado es porque el flujo viene de la creación de un edificio.
     * El parámetro se tiene que pasar a la acción de creación del domicilio para que en la creación se utilice el dato.
     *
     * @Route("/new/{edificio_id}", name="backend_domicilio_new", defaults={"edificio_id" = null} )
     * @Template()
     */
    public function newAction($edificio_id) {

        $entity = new Domicilio();

        $form = $this->createForm(new DomicilioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
            'edificio_id' => $edificio_id,
        );
    }

    /**
     * Creates a new Domicilio entity.
     * No esta controlando el domicilio principal unico.
     * pasar esto al repo
     *
     * @Route("/create/{edificio_id}", name="backend_domicilio_create", defaults={"edificio_id" = null})
     * @Method("post")
     */
    public function createAction($edificio_id) {

        $respuesta = new Respuesta();

        $entity = new Domicilio();

        $request = $this->getRequest();
        $form = $this->createForm(new DomicilioType(), $entity);

        $form->bind($request);

        if ($form->isValid()) {

            if ($edificio_id) {
                
                $edificio = $this->getDoctrine()
                        ->getRepository('EdificioBundle:Edificio')
                        ->find($edificio_id);
            } else {
                
                $edificio = null;
            }

            $respuesta = $this->getManager()->crear($entity, $edificio);

            if ($respuesta->getCodigo() == 1) {

                $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());

                return $this->redirect($this->generateUrl('backend_domicilio_edit', array(
                                    'id' => $respuesta->getObjNuevo()->getId(),
                )));
            }
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas con el formulario. Verifique y reintente.');

        return $this->render('BackendBundle:Domicilio:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Domicilio entity.
     *
     * @Route("/{id}/edit", name="backend_domicilio_edit")
     * @Template()
     */
    public function editAction($id) {

        $entity = $this->getRepo()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $editForm = $this->createForm(new DomicilioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Domicilio entity.
     *
     * @Route("/{id}/update", name="backend_domicilio_update")
     * @Method("post")
     * 
     */
    public function updateAction($id, Request $request) {
        $respuesta = new Respuesta();

        $entity = $this->getRepo()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Domicilio entity.');
        }

        $editForm = $this->createForm(new DomicilioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $respuesta = $repository->actualizar($entity);
        } else {
            $respuesta->setMensaje('La información cargada es incorrecta. Verifique y reintente');
        }

        $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje());

        return $this->render("BackendBundle:Domicilio:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Domicilio entity.
     *
     * @Route("/{id}/delete", name="backend_domicilio_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            
            $entity = $this->getRepo()->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Domicilio entity.');
            }

            $this->getEm()->remove($entity);
            $this->getEm()->flush();
        }

        return $this->redirect($this->generateUrl('backend_domicilio'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
