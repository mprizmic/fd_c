<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\EstadoCarrera;
use Fd\BackendBundle\Form\EstadoCarreraType;

/**
 * EstadoCarrera controller.
 *
 * @Route("/estadocarrera")
 */
class EstadoCarreraController extends Controller
{
    /**
     * Lists all EstadoCarrera entities.
     *
     * @Route("/", name="backend_estadocarrera")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:EstadoCarrera')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a EstadoCarrera entity.
     *
     * @Route("/{id}/show", name="backend_estadocarrera_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCarrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new EstadoCarrera entity.
     *
     * @Route("/new", name="backend_estadocarrera_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EstadoCarrera();
        $form   = $this->createForm(new EstadoCarreraType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new EstadoCarrera entity.
     *
     * @Route("/create", name="backend_estadocarrera_create")
     * @Method("post")
     * @Template("TablaBundle:EstadoCarrera:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new EstadoCarrera();
        $request = $this->getRequest();
        $form    = $this->createForm(new EstadoCarreraType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_estadocarrera_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing EstadoCarrera entity.
     *
     * @Route("/{id}/edit", name="backend_estadocarrera_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCarrera entity.');
        }

        $editForm = $this->createForm(new EstadoCarreraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EstadoCarrera entity.
     *
     * @Route("/{id}/update", name="backend_estadocarrera_update")
     * @Method("post")
     * @Template("TablaBundle:EstadoCarrera:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:EstadoCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstadoCarrera entity.');
        }

        $editForm   = $this->createForm(new EstadoCarreraType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_estadocarrera_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EstadoCarrera entity.
     *
     * @Route("/{id}/delete", name="backend_estadocarrera_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:EstadoCarrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstadoCarrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_estadocarrera'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
