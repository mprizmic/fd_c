<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\BackendBundle\Form\UnidadOfertaType;

/**
 * UnidadOferta controller.
 *
 * @Route("/unidadoferta")
 */
class UnidadOfertaController extends Controller {

    private $em;

    /**
     * Lists all UnidadOferta entities.
     *
     * @Route("/", name="backend_unidadoferta")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('EstablecimientoBundle:UnidadOferta')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Lista de unidades_oferta para un combo formateados en html como combo
     * Filtrado por unidad_educativa
     * 
     * @Route("/combo/{unidad_educativa_id}", name="backend_unidad_oferta_combo")
     */
    public function comboAction($unidad_educativa_id) {

        try {
            $unidad_educativa = $this->getEm()->getRepository('EstablecimientoBundle:UnidadEducativa')->find($unidad_educativa_id);
        } catch (Exception $e) {
            throw new createNotFoundException();
        };

        $entities = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')
                ->qbCarrerasPorEstablecimiento($unidad_educativa_id)
                ->getQuery()
                ->getResult()
        ;

        return $this->render('EstablecimientoBundle:UnidadOferta:combo.html.twig', array(
                    'unidad_ofertas' => $entities,
                ));
    }

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * Finds and displays a UnidadOferta entity.
     *
     * @Route("/{id}/show", name="backend_unidadoferta_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EstablecimientoBundle:UnidadOferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UnidadOferta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new UnidadOferta entity.
     *
     * @Route("/new", name="backend_unidadoferta_new")
     * @Template()
     */
    public function newAction() {
        $entity = new UnidadOferta();
        $form = $this->createForm(new UnidadOfertaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new UnidadOferta entity.
     *
     * @Route("/create", name="backend_unidadoferta_create")
     * @Method("post")
     * @Template("EstablecimientoBundle:UnidadOferta:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new UnidadOferta();
        $form = $this->createForm(new UnidadOfertaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashbag()->add('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_unidadoferta_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing UnidadOferta entity.
     *
     * @Route("/{id}/edit", name="backend_unidadoferta_edit")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EstablecimientoBundle:UnidadOferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UnidadOferta entity.');
        }

        $editForm = $this->createForm(new UnidadOfertaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing UnidadOferta entity.
     *
     * @Route("/{id}/update", name="backend_unidadoferta_update")
     * @Method("post")
     * @Template("EstablecimientoBundle:UnidadOferta:edit.html.twig")
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EstablecimientoBundle:UnidadOferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UnidadOferta entity.');
        }

        $editForm = $this->createForm(new UnidadOfertaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');

            return $this->redirect($this->generateUrl('backend_unidadoferta_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a UnidadOferta entity.
     *
     * @Route("/{id}/delete", name="backend_unidadoferta_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EstablecimientoBundle:UnidadOferta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UnidadOferta entity.');
            }

            $em->remove($entity);
            $em->flush();

            $this->get('session')->setFlash('notice', 'Guardado exitosamente');
        }

        return $this->redirect($this->generateUrl('backend_unidadoferta'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
