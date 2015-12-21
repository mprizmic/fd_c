<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Cargo;
use Fd\BackendBundle\Form\CargoType;

/**
 * Cargo controller.
 *
 * @Route("/cargo")
 */
class CargoController extends Controller
{
    /**
     * Lists all Cargo entities.
     *
     * @Route("/", name="backend_cargo")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Cargo')->findAllOrdenado('nombre');

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Cargo entity.
     *
     * @Route("/{id}/show", name="backend_cargo_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cargo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cargo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Cargo entity.
     *
     * @Route("/new", name="backend_cargo_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cargo();
        $form   = $this->createForm(new CargoType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Cargo entity.
     *
     * @Route("/create", name="backend_cargo_create")
     * @Method("post")
     * @Template("TablaBundle:Cargo:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Cargo();
        $request = $this->getRequest();
        $form    = $this->createForm(new CargoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');            

            return $this->redirect($this->generateUrl('backend_cargo_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Cargo entity.
     *
     * @Route("/{id}/edit", name="backend_cargo_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cargo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cargo entity.');
        }

        $editForm = $this->createForm(new CargoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Cargo entity.
     *
     * @Route("/{id}/update", name="backend_cargo_update")
     * @Method("post")
     * @Template("TablaBundle:Cargo:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Cargo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cargo entity.');
        }

        $editForm   = $this->createForm(new CargoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('exito', 'Se guardó exitosamente');

            return $this->redirect($this->generateUrl('backend_cargo_edit', array('id' => $id)));
        }

        $this->get('session')->getFlashBag()->add('error', 'Problemas en el guardado. Verifique y reintente');
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cargo entity.
     *
     * @Route("/{id}/delete", name="backend_cargo_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Cargo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cargo entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');            
        }

        return $this->redirect($this->generateUrl('backend_cargo'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
