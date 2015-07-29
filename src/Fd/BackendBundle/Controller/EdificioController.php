<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\BackendBundle\Form\EdificioType;
use Fd\EdificioBundle\Entity\Edificio;
use Fd\EdificioBundle\Form\Handler\EdificioHandler;
use Fd\EstablecimientoBundle\Entity\Respuesta;

use Fd\EdificioBundle\EventListener;
use Fd\EdificioBundle\Event\EdificioEvents;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Fd\EdificioBundle\Event\EdificioNuevoEvent;
/**
 * Edificio controller.
 *
 * @Route("/edificio")
 */
class EdificioController extends Controller {

    private $handler;
    private $em;
    
    public function getEm(){
        if (!$em){
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $em;
    }

    public function getHandler() {
        if (!$this->handler) {
            $this->handler = $this->get('fd.edificio.handler.edificio');
        };
        return $this->handler;
    }

    /**
     * Lists all Edificio entities.
     *
     * @Route("/", name="backend_edificio")
     */
    public function indexAction() {

        $entities = $this->getHandler()->getAllOrdenado();

        return $this->render('BackendBundle:Edificio:index.html.twig', array(
                    'entities' => $entities,
                ));
    }

    /**
     * Finds and displays a Edificio entity.
     *
     * @Route("/{id}/show", name="backend_edificio_show")
     * @ParamConverter("edificio", class="EdificioBundle:Edificio")
     * @Template()
     */
    public function showAction(Edificio $edificio) {

        $deleteForm = $this->createDeleteForm($edificio->getId());

        return array(
            'entity' => $edificio,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Edificio entity.
     *
     * @Route("/new", name="backend_edificio_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Edificio();
        $form = $this->createForm(new EdificioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Edificio entity.
     *
     * @Route("/create", name="backend_edificio_create")
     * @Method("post")
     * @Template("EdificioBundle:Edificio:new.html.twig")
     */
    public function createAction(Request $request) {

        //esto tiene que ser reescrito en el manager/handler
        $entity = new Edificio();

        $form = $this->createForm(new EdificioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            
            $handler = $this->getHandler();
            $handler->create( $form->getData() );
            
            return $this->redirect($this->generateUrl('backend_edificio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Edificio entity.
     *
     * @Route("/{id}/edit", name="backend_edificio_edit")
     * @ParamConverter("edificio", class="EdificioBundle:Edificio")
     * @Template()
     */
    public function editAction(Edificio $edificio) {

        $editForm = $this->createForm(new EdificioType(), $edificio);
        $deleteForm = $this->createDeleteForm($edificio->getId());

        return array(
            'entity' => $edificio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Edificio entity.
     *
     * @Route("/{id}/update", name="backend_edificio_update")
     * @Method("post")
     * @Template("BackendBundle:Edificio:edit.html.twig")
     * @ParamConverter("edificio", class="EdificioBundle:Edificio")
     */
    public function updateAction(Edificio $edificio, Request $request) {

        $editForm = $this->createForm(new EdificioType(), $edificio);
        $deleteForm = $this->createDeleteForm($edificio->getId());

        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $handler = $this->getHandler();
            $respuesta = $handler->update($edificio);
            
            $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje() );

            return $this->redirect($this->generateUrl('backend_edificio_edit', array('id' => $edificio->getId())));
        }

        $this->get('session')->getFlashBag()->add('error', $respuesta->getMensaje() );
        
        return array(
            'entity' => $edificio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Edificio entity.No va a borrar en la medida en que no se borren los domicilios que le corresponden
     *
     * @Route("/{id}/delete", name="backend_edificio_delete")
     * @ParamConverter("edificio", class="EdificioBundle:Edificio")
     * @Method("post")
     */
    public function deleteAction($edificio, Request $request) {

        $form = $this->createDeleteForm($edificio->getId());

        $form->bind($request);

        if ($form->isValid()) {

            $edificio_handler = $this->getHandler();
            $respuesta = $edificio_handler->delete($edificio);

            $this->get('session')->getFlashBag()->add('notice', $respuesta->getMensaje() );
        }else{
            $this->get('session')->getFlashBag()->add('notice', 'No se pudo eliminar el edificio y sus domicilios. Verifique y reintente.');
            
        }
        return $this->redirect($this->generateUrl('backend_edificio'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
