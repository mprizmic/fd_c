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
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Model\DocentesNivelClass;
use Fd\EstablecimientoBundle\Model\DocentesNivelManager;
use Fd\EstablecimientoBundle\Model\MatriculaNivelClass;
use Fd\EstablecimientoBundle\Model\MatriculaNivelManager;
//use Fd\EstablecimientoBundle\Model\LocalizacionHandler;
use Fd\BackendBundle\Form\EstablecimientoEdificioType;
use Fd\BackendBundle\Form\Model\DocentesNivelType;
use Fd\BackendBundle\Form\Model\MatriculaNivelType;
use Fd\BackendBundle\Form\Handler\DocentesNivelFormHandler;
use Fd\BackendBundle\Form\Handler\MatriculaNivelFormHandler;

/**
 * EstablecimientoEdificio controller.
 *
 * @Route("/establecimiento_edificio")
 */
class EstablecimientoEdificioController extends Controller {

    private $em;

    private function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * @Route("/docentes_nivel/editar/{establecimiento_edificio_id}",  name="backend_establecimiento_edificio_docentes_nivel_editar")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id"="establecimiento_edificio_id"})
     */
    public function docentesNivelEditarAction(EstablecimientoEdificio $establecimiento_edificio) {

        $em = $this->getDoctrine()->getEntityManager();
        $niveles = $em->getRepository('TablaBundle:Nivel')->descripciones_niveles();

        $docentes_nivel = new DocentesNivelClass($establecimiento_edificio);

        $editForm = $this->createForm(new DocentesNivelType($establecimiento_edificio, $niveles), $docentes_nivel);

        return $this->render('BackendBundle:Docentes:edit.html.twig', array(
                    'entity' => $docentes_nivel,
                    'edit_form' => $editForm->createView(),
        ));
    }

    /**
     * @Route("/docentes_nivel/actualizar/{establecimiento_edificio_id}",  name="backend_establecimiento_edificio_docentes_nivel_actualizar")
     * @Method("post")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id"="establecimiento_edificio_id"})
     */
    public function docentesNivelActualizarAction(EstablecimientoEdificio $establecimiento_edificio, Request $request) {

        $respuesta = new Respuesta();

        $niveles = $this->getEm()->getRepository('TablaBundle:Nivel')->descripciones_niveles();

        $docentes_nivel_anterior = new DocentesNivelClass($establecimiento_edificio);

        $formulario = $this->createForm(new DocentesNivelType($establecimiento_edificio, $niveles), $docentes_nivel_anterior);

        $form_handler = new DocentesNivelFormHandler(new DocentesNivelManager($this->getEm(), $this->get('fd.establecimiento.model.localizacion')));

        $respuesta = $form_handler->actualizar($formulario, $request);

        if ($respuesta->getCodigo() == 1) {
            $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());
            return $this->redirect($this->generateUrl('backend_establecimiento_edificio_docentes_nivel_editar', array('establecimiento_edificio_id' => $establecimiento_edificio->getId())));
        };

        $this->get('session')->getFlashBag()->add('aviso', $respuesta->getMensaje());
        return $this->render('BackendBundle:Docentes:edit.html.twig', array(
                    'entity' => $docentes_nivel,
                    'edit_form' => $formulario->createView(),
        ));
    }

    /**
     * devuelve las localizaciones de un establecimiento dado
     * 
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
    public function updateAction(EstablecimientoEdificio $entity) {
        $em = $this->getDoctrine()->getEntityManager();

        $editForm = $this->createForm(new EstablecimientoEdificioType(), $entity);
        $deleteForm = $this->createDeleteForm($entity->getId());

        $editForm->bind($this->getRequest());

        if ($editForm->isValid()) {

            $em->persist($entity);
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('exito', 'La sede/anexo fue actualizado exitosamente');
        }else{
            $this->get('session')->getFlashBag()->add('error', 'La sede/anexo no pudo ser actualizado. Verifique y reintente.');
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

    /**
     * @Route("/matricula_nivel/edit/{establecimiento_edificio_id}", name="backend.establecimiento_edificio.matricula_nivel.edit")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id":"establecimiento_edificio_id"})
     */
    public function matricula_nivel_editAction(Request $request, EstablecimientoEdificio $establecimiento_edificio) {
        
        $niveles = $this->getEm()->getRepository('TablaBundle:Nivel')->descripciones_niveles();

        $matricula_nivel = new MatriculaNivelClass($establecimiento_edificio);

        $editForm = $this->createForm(new MatriculaNivelType($establecimiento_edificio, $niveles), $matricula_nivel);

        return $this->render('BackendBundle:Matricula:edit.html.twig', array(
                    'entity' => $matricula_nivel,
                    'edit_form' => $editForm->createView(),
        ));
    }
    /**
     * @Route("/matricula_nivel/actualizar/{establecimiento_edificio_id}",  name="backend.establecimiento_edificio.matricula_nivel.actualizar")
     * @Method("post")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id"="establecimiento_edificio_id"})
     */
    public function matriculaNivelActualizarAction(EstablecimientoEdificio $establecimiento_edificio, Request $request) {

        $respuesta = new Respuesta();

        $niveles = $this->getEm()->getRepository('TablaBundle:Nivel')->descripciones_niveles();

        $matricula_nivel_anterior = new MatriculaNivelClass($establecimiento_edificio);

        $formulario = $this->createForm(new MatriculaNivelType($establecimiento_edificio, $niveles), $matricula_nivel_anterior);

        $form_handler = new MatriculaNivelFormHandler(new MatriculaNivelManager($this->getEm(), $this->get('fd.establecimiento.model.localizacion')));

        $respuesta = $form_handler->actualizar($formulario, $request);

        if ($respuesta->getCodigo() == 1) {
            $this->get('session')->getFlashBag()->add('exito', $respuesta->getMensaje());
            return $this->redirect($this->generateUrl('backend.establecimiento_edificio.matricula_nivel.edit',
                    array('establecimiento_edificio_id' => $establecimiento_edificio->getId())));
        };

        $this->get('session')->getFlashBag()->add('aviso', $respuesta->getMensaje());
        return $this->render('BackendBundle:Matricula:edit.html.twig', array(
                    'entity' => $matricula_nivel,
                    'edit_form' => $formulario->createView(),
        ));
    }
}
