<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\BackendBundle\Form\EstablecimientoEdificioType;

/**
 * EstablecimientoEdificio controller.
 *
 * @Route("/establecimiento_edificio")
 */
class EstablecimientoEdificioController extends Controller {

    /**
     * @Route("/listar/{id}", name="backend_establecimiento_edificio_listar")
     * @Template("BackendBundle:EstablecimientoEdificio:listar.html.twig")
     */
    public function listarAction($id) {

        $em = $this->getDoctrine()->getEntityManager();
        $establecimiento = $em->getRepository('EstablecimientoBundle:Establecimiento')->find($id);

        $entities = $em->getRepository("EstablecimientoBundle:EstablecimientoEdificio")
                ->findBy(array(
            'establecimientos' => $establecimiento->getId(),
                ));
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all EstablecimientoEdificio entities.
     *
     * @Route("/", name="backend_establecimiento_edificio")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();

        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findAllOrdenado('orden');

        return array(
            'establecimientos' => $establecimientos,
        );
    }

    /**
     * Finds and displays a EstablecimientoEdificio entity.
     *
     * @Route("/{id}/show", name="backend_establecimiento_edificio_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EstablecimientoEdificio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new EstablecimientoEdificio entity.
     *
     * @Route("/new", name="backend_establecimiento_edificio_new")
     * @Template()
     */
    public function newAction() {
        $entity = new EstablecimientoEdificio();
        $form = $this->createForm(new EstablecimientoEdificioType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }
    /**
     * Creates a new EstablecimientoEdificio entity.
     *
     * @Route("/create", name="backend_establecimiento_edificio_create")
     * @Method("post")
     * @Template("BackendBundle:EstablecimientoEdificio:new.html.twig")
     */
    public function createAction() {
        $entity = new EstablecimientoEdificio();
        $request = $this->getRequest();
        $form = $this->createForm(new EstablecimientoEdificioType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_establecimiento_edificio_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing EstablecimientoEdificio entity.
     *
     * @Route("/{id}/edit", name="backend_establecimiento_edificio_edit")
     * @ParamConverter("entity", class="EstablecimientoBundle:EstablecimientoEdificio")
     * @Template()
     */
    public function editAction(EstablecimientoEdificio $entity) {
        $em = $this->getDoctrine()->getEntityManager();

        $editForm = $this->createForm(new EstablecimientoEdificioType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing EstablecimientoEdificio entity.
     *
     * @Route("/{id}/update", name="backend_establecimiento_edificio_update")
     * @Method("post")
     * @Template("BackendBundle:EstablecimientoEdificio:edit.html.twig")
     * @ParamConverter("entity", class="EstablecimientoBundle:EstablecimientoEdificio")
     */
    public function updateAction(EstablecimientoEdificio $entity, Request $request) {
        $em = $this->getDoctrine()->getEntityManager();

        $editForm = $this->createForm(new EstablecimientoEdificioType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            //no funciona
            if ($entity->getEstablecimientos()->esAnexo( $entity->getCueAnexo() )){
                $this->get('session')->getFlashBag()->add('notice', 'Ya existe el nro de anexo. Verifíquelo');
            };
            
            $em->persist($entity);
            $em->flush();

//            return $this->redirect($this->generateUrl('backend_establecimiento_edificio_edit', array(
//                                'id' => $entity->getId(),
//                            )));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a EstablecimientoEdificio entity.
     *
     * @Route("/{id}/delete", name="backend_establecimiento_edificio_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('EstablecimientoBundle:EstablecimientoEdificio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EstablecimientoEdificio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_establecimiento_edificio'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
