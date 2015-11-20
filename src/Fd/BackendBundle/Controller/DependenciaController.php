<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\TablaBundle\Entity\Dependencia;
use Fd\TablaBundle\Model\DependenciaManager;
use Fd\BackendBundle\Form\DependenciaType;

/**
 * @Route("/dependencia")
 */
class DependenciaController extends Controller {

    private $em;
    private $manager;

    public function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('TablaBundle:Dependencia');
    }

    public function getManager() {
        if (!$this->manager) {
            $this->manager = new DependenciaManager($this->getEm());
        };
        return $this->manager;
    }

    /**
     * Lists all Dependencia entities.
     *
     * @Route("/", name="backend.dependencia.index")
     * @Template()
     */
    public function indexAction() {

        $entities = $this->getRepository()->findBy(array(), array('orden' => 'ASC'));

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Dependencia entity.
     *
     * @Route("/{id}/show", name="backend.dependencia.show")
     * @Template()
     * @ParamConverter("entity", class="TablaBundle:Dependencia")
     */
    public function showAction($entity) {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Dependencia entity.
     *
     * @Route("/new", name="backend.dependencia.new" )
     * @Template()
     */
    public function newAction() {

        $entity = DependenciaManager::crearNuevo();

        $form = $this->createForm(new DependenciaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a new Dependencia entity.
     *
     * @Route("/create", name="backend.dependencia.create")
     * @Method("post")
     */
    public function createAction() {

        $respuesta = new Respuesta();

        $entity = DependenciaManager::crearNuevo();

        $request = $this->getRequest();
        $form = $this->createForm(new DependenciaType(), $entity);

        $form->bindRequest($request);

        if ($form->isValid()) {

            $respuesta = $this->getManager()->crear($entity);

            if ($respuesta->getCodigo() == 1) {

                $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());

                return $this->redirect($this->generateUrl('backend.dependencia.edit', array(
                                    'id' => $respuesta->getObjNuevo()->getId(),
                )));
            }
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas con el formulario. Verifique y reintente.');

        return $this->render('BackendBundle:Dependencia:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Dependencia entity.
     *
     * @Route("/{id}/edit", name="backend.dependencia.edit")
     * @Template()
     * @ParamConverter("entity", class="TablaBundle:Dependencia")
     */
    public function editAction($entity) {

        $editForm = $this->createForm(new DependenciaType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Dependencia entity.
     *
     * @Route("/{id}/update", name="backend.dependencia.update")
     * @Method("post")
     * @ParamConverter("entity", class="TablaBundle:Dependencia")
     * 
     */
    public function updateAction($entity, Request $request) {

        $respuesta = new Respuesta();

        $editForm = $this->createForm(new DependenciaType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $respuesta = $this->getManager()->actualizar($entity);
        } else {
            $respuesta->setMensaje('La información cargada es incorrecta. Verifique y reintente');
        }

        $tipo = $respuesta->getCodigo() == 1 ? 'exito' : 'error';
        
        $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

        return $this->render("BackendBundle:Dependencia:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Dependencia entity.
     *
     * @Route("/{id}/delete", name="backend.dependencia.delete")
     * @Method("post")
     * @ParamConverter("entity", class="TablaBundle:Dependencia")
     */
    public function deleteAction($entity) {
        
        $form = $this->createDeleteForm($entity->getId());
        
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {

            $respuesta = $this->getManager()->eliminar($entity);
            
            if ($respuesta->getCodigo() == 1){
                
                $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());

                return $this->redirect($this->generateUrl('backend.dependencia.index'));
            }
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas con el formulario. Verifique y reintente.');
        
        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render("BackendBundle:Dependencia:edit.html.twig", array(
                    'entity' => $entity,
                    'edit_form' => $form->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
