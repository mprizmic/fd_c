<?php

/**
 * Corresponde a una oferta educativa de tipo SECUNDARIO existente en una localización determinada. 
 * Es una instancia de la NES 
 * en el frontend
 */

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Utilities\Destino;
use Fd\OfertaEducativaBundle\Entity\SecundarioX;
use Fd\OfertaEducativaBundle\Model\SecundarioXHandler;
use Fd\BackendBundle\Form\SecundarioXType;

/**
 *
 * @Route("/secundariox")
 */
class SecundarioXController extends Controller {

    private $em;
    private $handler;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getHandler() {
        if (!$this->handler) {
            $this->handler = new SecundarioXHandler($this->getEm());
        };
        return $this->handler;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:SecundarioX');
    }

//    /**
//     * @Route("/new", name="backend.secundariox.new")
//     * @Template()
//     */
//    public function newAction() {
//        $entity = $this->getHandler()->crearObjeto();
//        $form = $this->createForm(new SecundarioXType(), $entity);
//
//        return array(
//            'entity' => $entity,
//            'form' => $form->createView()
//        );
//    }
//
//    /**
//     * Creates a new orientacion entity a partir de un unidad_oferta_id.
//     *
//     * @Route("/crear/{unidad_oferta_id}", name="backend.secundariox.crear")
//     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"unidad_oferta_id"})
//     */
//    public function crearAction(Request $request, $unidad_oferta) {
//        $entity = $this->getHandler()->crear($unidad_oferta, true);
//        return $this->redirect($this->generateUrl('backend.secundariox.edit', array('id' => $entity->getId())));
//    }
//
    /**
     * Displays una nes localizada en un establecimiento
     *
     * @Route("/{id}/show/{establecimiento_id}", name="oferta_educativa.secundariox.show")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"id"})
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id":"establecimiento_id"})
     */
    public function showAction(UnidadOferta $unidad_oferta, $establecimiento) {

        $secundario_x = $unidad_oferta->getSecundario();

        if ($secundario_x) {

            $volver = Destino::generateUrlDesdeSession($this->get('session'), $this->get('router'));

            return $this->render('OfertaEducativaBundle:SecundarioX:show.html.twig', array(
                        'unidad_oferta' => $unidad_oferta,
                        'secundario_x' => $secundario_x,
                        'volver' => $volver,
                    ))
            ;
        } else {
            // si no tiene el nivel medio definido por su oferta se lo deriva a la dirección para crearlo
            return $this->redirect($this->generateUrl('backend_unidadoferta'));
        }
    }

//
//    /**
//     * Edits an existing orientación entity.
//     *
//     * @Route("/{id}/update", name="backend.secundariox.update")
//     * @Method("post")
//     * @Template("BackendBundle:SecundarioX:edit.html.twig")
//     * @ParamConverter("entity", class="OfertaEducativaBundle:SecundarioX")
//     */
//    public function updateAction($entity) {
//
//        $editForm = $this->createForm(new SecundarioXType(), $entity);
//
//        $deleteForm = $this->createDeleteForm($entity->getId());
//        
//        $originalOrientaciones = array();
//        foreach ($entity->getOrientaciones() as $orientacion) {
//            $originalOrientaciones[] = $orientacion;
//        }        
//
//        $request = $this->getRequest();
//
//        $editForm->bindRequest($request);
//
//        if ($editForm->isValid()) {
//            
//            $respuesta = $this->getHandler()->actualizar($entity, $originalOrientaciones);
//
//            $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';
//
//            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());
//
//            return $this->redirect($this->generateUrl('backend.secundariox.edit', array('id' => $entity->getId())));
//        }
//
//        return array(
//            'entity' => $entity,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        );
//    }
//
//    /**
//     * Deletes a SecundarioX entity.
//     *
//     * @Route("/{id}/delete", name="backend.secundariox.delete")
//     * @Method("post")
//     * @ParamConverter("entity", class="OfertaEducativaBundle:SecundarioX")
//     */
//    public function deleteAction($entity) {
//        $form = $this->createDeleteForm($entity->getId());
//        $request = $this->getRequest();
//
//        $form->bindRequest($request);
//
//        if ($form->isValid()) {
//
//            $this->getEm()->remove($entity);
//            $this->getEm()->flush();
//        }
//
//        return $this->redirect($this->generateUrl('backend.secundariox.new'));
//    }
//
//    private function createDeleteForm($id) {
//        return $this->createFormBuilder(array('id' => $id))
//                        ->add('id', 'hidden')
//                        ->getForm()
//        ;
//    }
}
