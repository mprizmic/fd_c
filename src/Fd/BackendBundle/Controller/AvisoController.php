<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Aviso;
use Fd\TablaBundle\Form\AvisoType;
use Fd\TablaBundle\Filter\AvisoFilterType;

/**
 * Aviso controller.
 *
 * @Route("/aviso")
 */
class AvisoController extends Controller {

    /**
     * @Route("/filtro", name="aviso_filtro")
     */
    public function AvisoFilterAction(){
       $form = $this->get('form.factory')->create(new AvisoFilterType());

        if ($this->get('request')->getMethod() == 'POST') {
            // bind values from the request
            $form->bindRequest($this->get('request'));

            // initliaze a query builder
            $queryBuilder = $this->get('doctrine.orm.entity_manager')
                ->getRepository('TablaBundle:Aviso')
                ->createQueryBuilder('b');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder')->buildQuery($form, $queryBuilder);

            // now look at the DQL =)
            var_dump($queryBuilder->getDql());
        }

        return $this->render('BackendBundle:Aviso:filtro.html.twig', array(
            'form' => $form->createView(),
        ));        
    }
    /**
     * Lists all Aviso entities.
     *
     * @Route("/index", name="backend_aviso")
     * @Template("BackendBundle:Aviso:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Aviso')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Aviso entity.
     *
     * @Route("/{id}/show", name="backend_aviso_show")
     * @Template("BackendBundle:Aviso:show.html.twig")
     */
    public function showAction(Aviso $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Aviso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aviso entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Aviso entity.
     *
     * @Route("/new", name="backend_aviso_new")
     * @Template("BackendBundle:Aviso:new.html.twig")
     */
    public function newAction() {
        $entity = new Aviso();
        $form = $this->createForm(new AvisoType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Aviso entity.
     *
     * @Route("/create", name="backend_aviso_create")
     * @Method("post")
     * @Template("BackendBundle:Aviso:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Aviso();
//        $request = $this->getRequest();
        $form = $this->createForm(new AvisoType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_aviso_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Aviso entity.
     * 
     * Si se pasa como parámetro a la entidad no hace falta pasar el id por que doctrine lo busca automáticamente
     *
     * @Route("/{id}/edit", name="backend_aviso_edit")
     * @Template("BackendBundle:Aviso:edit.html.twig")
     */
    public function editAction(Aviso $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Aviso')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Aviso entity.');
//        }

        $editForm = $this->createForm(new AvisoType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Aviso entity.
     *
     * @Route("/{id}/update", name="backend_aviso_update")
     * @Method("post")
     * @Template("BackendBundle:Aviso:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Aviso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aviso entity.');
        }

        $editForm = $this->createForm(new AvisoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');

            return $this->redirect($this->generateUrl('backend_aviso'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Aviso entity.
     *
     * @Route("/{id}/delete", name="backend_aviso_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Aviso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aviso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_aviso'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
