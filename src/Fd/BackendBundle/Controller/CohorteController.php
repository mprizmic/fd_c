<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\Cohorte;
use Fd\BackendBundle\Form\CohorteType;

/**
 * Cohorte controller.
 *
 * @Route("/cohorte")
 */
class CohorteController extends Controller {

    private $em;

    public function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * Devuelve un pedazo de html con la lista de los años en que hay cargada matrícula para la carrera y la localizacion informados
     * 
     * @Route("/listar/{establecimiento_id}/{carrera_id}", name="backend_cohorte_listar")
     * @Template("BackendBundle:Cohorte:listar.html.twig")
     * @ParamConverter("localizacion", class="EstablecimientoBundle:Localizacion", options={"id":"establecimiento_id"})
     * @ParamConverter("carrera", class="OfertaEducativaBundle:Carrera", options={"id":"carrera_id"})
     */
    public function listarAction($localizacion, $carrera) {

        $unidad_oferta = $this->getEm()->getRepository('EstablecimientoBundle:UnidadOferta')->findUnidadOferta($localizacion, $carrera);

        $entities = $this->getEm()->getRepository("OfertaEducativaBundle:Cohorte")
                ->findCohortes($unidad_oferta[0]);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Cohorte entities.
     *
     * @Route("/", name="backend_cohorte")
     * @Template()
     */
    public function indexAction() {

        $terciarios = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')->findTerciarios();
        $carreras = $this->getEm()->getRepository('OfertaEducativaBundle:Carrera')->findAllOrdenado('nombre');

        return array(
            'sedes_anexos' => $terciarios,
            'carrera' => $carreras,
        );
    }

    /**
     * Finds and displays a Cohorte entity.
     *
     * @Route("/{id}/show", name="backend_cohorte_show")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('OfertaEducativaBundle:Cohorte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cohorte entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),);
    }

    /**
     * Displays a form to create a new Cohorte entity.
     *
     * @Route("/new", name="backend_cohorte_new")
     * @Template()
     */
    public function newAction() {
        $entity = new Cohorte();
        $entity->setAnio(date('Y') * 1);

        $form = $this->createForm(new CohorteType(), $entity);

        return array(
            'entity' => $entity,
            'edit_form' => $form->createView()
        );
    }

    /**
     * Creates a new Cohorte entity.
     *
     * @Route("/create", name="backend_cohorte_create")
     * @Method("post")
     * @Template("BackendBundle:Cohorte:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Cohorte();
        $form = $this->createForm(new CohorteType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            try {
                $this->getEm()->persist($entity);
                $this->getEm()->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Los datos se crearon exitosamente.');
                return $this->redirect($this->generateUrl('backend_cohorte_edit', array('id' => $entity->getId())));
            } catch (Exception $e) {
                $this->get('session')->getFlashBag()->add('error', 'Los datos no se pudieron grabar. Verifique y reintente.');
            }
        }
        $this->get('session')->getFlashBag()->add('error', 'Los datos con inválidos. Verifique y reintente.');

        return array(
            'entity' => $entity,
            'edit_form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Cohorte entity.
     *
     * @Route("/{id}/edit", name="backend_cohorte_edit")
     * @Template()
     */
    public function editAction($id) {

        $entity = $this->getEm()->getRepository('OfertaEducativaBundle:Cohorte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cohorte entity.');
        }

        $editForm = $this->createForm(new CohorteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Cohorte entity.
     *
     * @Route("/{id}/update", name="backend_cohorte_update")
     * @Method("post")
     * @Template("BackendBundle:Cohorte:edit.html.twig")
     */
    public function updateAction($id) {
        $entity = $this->getEm()->getRepository('OfertaEducativaBundle:Cohorte')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cohorte entity.');
        }

        $editForm = $this->createForm(new CohorteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $this->getEm()->persist($entity);
            $this->getEm()->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Se guardó exitosamente');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'La información no fue guardada. Verifique y reintente.');
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cohorte entity.
     *
     * @Route("/{id}/delete", name="backend_cohorte_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('OfertaEducativaBundle:Cohorte')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cohorte entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_cohorte'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
