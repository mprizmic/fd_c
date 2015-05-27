<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Form\InicialXType;
use Fd\BackendBundle\Form\UnidadEducativaType;
use Fd\BackendBundle\Form\Handler\UnidadEducativaHandler;

/**
 * UnidadEducativa controller.
 *
 * @Route("/unidad_educativa")
 */
class UnidadEducativaController extends Controller {

    protected $handler;

    public function getHandler() {
        if (!$this->handler) {
            $this->handler = $this->get('fd.backend.handler.unidad_educativa');
        };
        return $this->handler;
    }

    /**
     * @Route("/listar/{id}", name="backend_unidad_educativa_listar", options={"expose"=true})
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento")
     * @Template("BackendBundle:UnidadEducativa:listar.html.twig")
     */
    public function listarAction($establecimiento) {

        $em = $this->getDoctrine()->getEntityManager();
//        $establecimiento = $em->getRepository('EstablecimientoBundle:Establecimiento')->find($id);

        $entities = $em->getRepository("EstablecimientoBundle:UnidadEducativa")
                ->findBy(array(
            'establecimiento' => $establecimiento->getId(),
                ));

        return array(
            'entities' => $entities,
        );
    }

    /**
     * @Route("/", name="backend_unidad_educativa")
     * @Template("BackendBundle:UnidadEducativa:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getEntityManager();
        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findAllOrdenado('orden');

        return array(
            'establecimientos' => $establecimientos,
        );
    }

    /**
     * Finds and displays a UnidadEducativa entity.
     *
     * @Route("/{id}/show", name="backend_unidad_educativa_show")
     * @ParamConverter("entity", class="EstablecimientoBundle:UnidadEducativa")
     * @Template("BackendBundle:UnidadEducativa:show.html.twig")
     */
    public function showAction($entity) {

        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new UnidadEducativa entity.
     *
     * @Route("/new", name="backend_unidad_educativa_new")
     * @Template("BackendBundle:UnidadEducativa:new.html.twig")
     */
    public function newAction() {
        $entity = new UnidadEducativa();
        $form = $this->createForm(new UnidadEducativaType(), $entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Creates a new UnidadEducativa entity.
     *
     * @Route("/create", name="backend_unidad_educativa_create")
     * @Method("post")
     * @Template("BackendBundle:UnidadEducativa:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new UnidadEducativa();
        $form = $this->createForm(new UnidadEducativaType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $handler = $this->getHandler();
            $respuesta = $handler->crear($entity);

            return $this->redirect($this->generateUrl('backend_unidad_educativa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing UnidadEducativa entity.
     *
     * @Route("/{id}/edit", name="backend_unidad_educativa_edit")
     * @Template("BackendBundle:UnidadEducativa:edit.html.twig")
     * @ParamConverter("unidad_educativa", class="EstablecimientoBundle:UnidadEducativa")
     */
    public function editAction(UnidadEducativa $unidad_educativa) {

        // FALTA esto sòlo funciona si los registros existen y si es nivel inicial??? parecerìa estar terminado

        $editForm = $this->getEditForm($unidad_educativa);

        $deleteForm = $this->createDeleteForm($unidad_educativa->getId());
        
        $respuesta = array(
            'entity' => $unidad_educativa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
        
        // FALTA se anula por el momento hasta que se revise. Es el edit de una unidad educativa de nivel inicial
//        if ($unidad_educativa->isInicial()){
//            /*
//             * inicial_x puede no tener salas.
//             */
//            $inicial_x = $this->getInicialX($unidad_educativa);
//            $respuesta['inicial_x'] = $inicial_x;
//        };
        
        return $this->render("BackendBundle:UnidadEducativa:edit.html.twig", $respuesta);
    }
    
    public function getInicialX(UnidadEducativa $unidad_educativa){
        $array_temp = $unidad_educativa->getLocalizaciones()->getOfertas();
        $inicial_x = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('OfertaEducativaBundle:InicialX')
                ->findSalas($array_temp[0]);
        return $inicial_x;
    }

    /**
     * Formulario de edición de unidad educativa genérica
     * 
     * @param type $unidad_educativa
     * @return type
     */
    private function getEditForm($unidad_educativa) {
        $editForm = $this->get('form.factory')
                ->createNamedBuilder('form_ue', new UnidadEducativaType(), $unidad_educativa)
                ->getForm();
        return $editForm;
    }

    private function getInicialXForm($inicial_x) {
        $editInicialXForm = $this->get('form.factory')
                ->createNamedBuilder('form_inicial_x', new InicialXType(), $inicial_x)
                ->getForm();
        return $editInicialXForm;
    }

    /**
     * Edits an existing UnidadEducativa entity.
     *
     * @Route("/{id}/update", name="backend_unidad_educativa_update")
     * @Method("post")
     * @Template("BackendBundle:UnidadEducativa:edit.html.twig")
     * @ParamConverter("entity", class="EstablecimientoBundle:UnidadEducativa")
     */
    public function updateAction(UnidadEducativa $entity, Request $request) {
        $respuesta = new Respuesta();

        $em = $this->getDoctrine()->getEntityManager();

        $repo = $em->getRepository('EstablecimientoBundle:UnidadEducativa');

        $editForm = $this->getEditForm($entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        $editForm->bind($request);

        if ($editForm->isValid()) {
            
            $handler = $this->getHandler();

            $respuesta = $handler->actualizar($entity, true);

            $session = $this->get('session');
            $session->setFlash('exito', $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend_unidad_educativa_edit', array('id' => $entity->getId())));
        }
        $respuesta->setMensaje('La información cargada es incorrecta. Verifique y reintente');
        $session = $this->get('session');
        $session->setFlash('error', $respuesta->getMensaje());

        $inicial_x = $this->getInicialX($entity);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'edit_inicial_x_form' => $this->getInicialXForm($inicial_x)->createView(),
            'inicial_x' => $inicial_x,
        );
    }

    /**
     * Deletes a UnidadEducativa entity.
     *
     * @Route("/{id}/delete", name="backend_unidad_educativa_delete")
     * @ParamConverter("entity", class="EstablecimientoBundle:UnidadEducativa")
     * @Method("post")
     */
    public function deleteAction($entity, Request $request) {

        $form = $this->createDeleteForm($entity->getId());

        $form->bind($request);

        if ($form->isValid()) {

            $handler = $this->getHandler();
            $respuesta = $handler->eliminar($entity);

            $mensaje = $respuesta->getMensaje();
        } else {
            $mensaje = 'Problemas en el formulario. Es inválido.';
        };

        $this->get('session')->getFlashBag()->add('error', $mensaje);

        return $this->redirect($this->generateUrl('backend_unidad_educativa'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
