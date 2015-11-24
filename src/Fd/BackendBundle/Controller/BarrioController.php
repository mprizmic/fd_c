<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Barrio;
use Fd\BackendBundle\Form\BarrioType;
use Fd\BackendBundle\Form\Filter\BarrioFilterType;

/**
 * Barrio controller.
 *
 * @Route("/barrio")
 */
class BarrioController extends Controller {

    /**
     * @Route("/filtro", name="filtro")
     */
    public function BarrioFilterAction(){
       $form = $this->get('form.factory')->create(new BarrioFilterType());

        if ($this->get('request')->getMethod() == 'POST') {
            // bind values from the request
            $form->bindRequest($this->get('request'));

            // initliaze a query builder
            $queryBuilder = $this->get('doctrine.orm.entity_manager')
                ->getRepository('TablaBundle:Barrio')
                ->createQueryBuilder('b');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder')->buildQuery($form, $queryBuilder);

            // now look at the DQL =)
            var_dump($queryBuilder->getDql());
        }

        return $this->render('BackendBundle:Barrio:filtro.html.twig', array(
            'form' => $form->createView(),
        ));        
    }
    /**
     * Lists all Barrio entities.
     *
     * @Route("/", name="backend_barrio")
     * @Template("BackendBundle:Barrio:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Barrio')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Barrio entity.
     *
     * @Route("/{id}/show", name="backend_barrio_show")
     * @Template("BackendBundle:Barrio:show.html.twig")
     */
    public function showAction(Barrio $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barrio entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Barrio entity.
     *
     * @Route("/new", name="backend_barrio_new")
     * @Template("BackendBundle:Barrio:new.html.twig")
     */
    public function newAction() {
        $entity = new Barrio();
        $form = $this->createForm(new BarrioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Barrio entity.
     *
     * @Route("/create", name="backend_barrio_create")
     * @Method("post")
     * @Template("BackendBundle:Barrio:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Barrio();
//        $request = $this->getRequest();
        $form = $this->createForm(new BarrioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_barrio_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Barrio entity.
     * 
     * Si se pasa como parámetro a la entidad no hace falta pasar el id por que doctrine lo busca automáticamente
     *
     * @Route("/{id}/edit", name="backend_barrio_edit")
     * @Template("BackendBundle:Barrio:edit.html.twig")
     */
    public function editAction(Barrio $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Barrio')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Barrio entity.');
//        }

        $editForm = $this->createForm(new BarrioType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Barrio entity.
     *
     * @Route("/{id}/update", name="backend_barrio_update")
     * @Method("post")
     * @Template("BackendBundle:Barrio:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Barrio entity.');
        }

        $editForm = $this->createForm(new BarrioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');

            return $this->redirect($this->generateUrl('backend_barrio'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Barrio entity.
     *
     * @Route("/{id}/delete", name="backend_barrio_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Barrio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Barrio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_barrio'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
