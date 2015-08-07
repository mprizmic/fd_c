<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\TablaBundle\Entity\Frase;
use Fd\TablaBundle\Form\FraseType;

/**
 * @Route("/frase")
 */
class FraseController extends Controller {

    /**
     * @Route("/filtro", name="frase_filtro")
     */
//    public function FraseFilterAction(){
//       $form = $this->get('form.factory')->create(new FraseFilterType());
//
//        if ($this->get('request')->getMethod() == 'POST') {
//            // bind values from the request
//            $form->bindRequest($this->get('request'));
//
//            // initliaze a query builder
//            $queryBuilder = $this->get('doctrine.orm.entity_manager')
//                ->getRepository('TablaBundle:Frase')
//                ->createQueryBuilder('b');
//
//            // build the query from the given form object
//            $this->get('lexik_form_filter.query_builder')->buildQuery($form, $queryBuilder);
//
//            // now look at the DQL =)
//            var_dump($queryBuilder->getDql());
//        }
//
//        return $this->render('BackendBundle:Frase:filtro.html.twig', array(
//            'form' => $form->createView(),
//        ));        
//    }
    /**
     * Lists all Frase entities.
     *
     * @Route("/index", name="backend_frase")
     * @Template("BackendBundle:Frase:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TablaBundle:Frase')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Frase entity.
     *
     * @Route("/{id}/show", name="backend_frase_show")
     * @Template("BackendBundle:Frase:show.html.twig")
     */
    public function showAction(Frase $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Frase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Frase entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Frase entity.
     *
     * @Route("/new", name="backend_frase_new")
     * @Template("BackendBundle:Frase:new.html.twig")
     */
    public function newAction() {
        $entity = new Frase();
        $form = $this->createForm(new FraseType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new Frase entity.
     *
     * @Route("/create", name="backend_frase_create")
     * @Method("post")
     * @Template("BackendBundle:Frase:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Frase();
//        $request = $this->getRequest();
        $form = $this->createForm(new FraseType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_frase_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Frase entity.
     * 
     * Si se pasa como parámetro a la entidad no hace falta pasar el id por que doctrine lo busca automáticamente
     *
     * @Route("/{id}/edit", name="backend_frase_edit")
     * @Template("BackendBundle:Frase:edit.html.twig")
     */
    public function editAction(Frase $entity) {
        $em = $this->getDoctrine()->getEntityManager();

//        $entity = $em->getRepository('TablaBundle:Frase')->find($id);
//
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find Frase entity.');
//        }

        $editForm = $this->createForm(new FraseType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Frase entity.
     *
     * @Route("/{id}/update", name="backend_frase_update")
     * @Method("post")
     * @Template("BackendBundle:Frase:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TablaBundle:Frase')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Frase entity.');
        }

        $editForm = $this->createForm(new FraseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $session = $this->get('session');
            $session->setFlash('notice', 'Se guardó exitosamente');

            return $this->redirect($this->generateUrl('backend_frase'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Frase entity.
     *
     * @Route("/{id}/delete", name="backend_frase_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TablaBundle:Frase')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Frase entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_frase'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
