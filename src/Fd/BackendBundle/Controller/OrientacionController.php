<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\OfertaEducativaBundle\Entity\Orientacion;
use Fd\BackendBundle\Form\OrientacionType;

/**
 * Orientacion controller.
 *
 * @Route("/orientacion")
 */
class OrientacionController extends Controller
{
    /**
     * Lists all Orientacion entities.
     *
     * @Route("/", name="backend_orientacion")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('OfertaEducativaBundle:Orientacion')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Orientacion entity.
     *
     * @Route("/{id}/show", name="backend_orientacion_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:Orientacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orientacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Orientacion entity.
     *
     * @Route("/new", name="backend_orientacion_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Orientacion();
        $form   = $this->createForm(new OrientacionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Orientacion entity.
     *
     * @Route("/create", name="backend_orientacion_create")
     * @Method("post")
     * @Template("OfertaEducativaBundle:Orientacion:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Orientacion();
        $request = $this->getRequest();
        $form    = $this->createForm(new OrientacionType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_orientacion_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Orientacion entity.
     *
     * @Route("/{id}/edit", name="backend_orientacion_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:Orientacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orientacion entity.');
        }

        $editForm = $this->createForm(new OrientacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Orientacion entity.
     *
     * @Route("/{id}/update", name="backend_orientacion_update")
     * @Method("post")
     * @Template("OfertaEducativaBundle:Orientacion:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:Orientacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orientacion entity.');
        }

        $editForm   = $this->createForm(new OrientacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
            
            return $this->redirect($this->generateUrl('backend_orientacion_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Orientacion entity.
     *
     * @Route("/{id}/delete", name="backend_orientacion_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OfertaEducativaBundle:Orientacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Orientacion entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_orientacion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
