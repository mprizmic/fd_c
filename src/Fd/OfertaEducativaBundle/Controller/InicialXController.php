<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Utilities\Destino;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Form\InicialXType;
use Fd\OfertaEducativaBundle\Model\InicialXHandler;

/**
 * @Route("/inicialx")
 */
class InicialXController extends Controller {

    private $em;
    private $handler;

    /**
     * devuelve el EntityManager
     */
    public function getEm() {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getHandler() {
        if (!$this->handler) {
            $this->handler = new InicialXHandler($this->getEm());
        };
        return $this->handler;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('OfertaEducativaBundle:InicialX');
    }

    /**
     * Displays a form to edit an existing  entity.
     *
     * @Route("/{id}/edit", name="backend.inicialx.edit")
     * @ParamConverter("entity", class="OfertaEducativaBundle:InicialX")
     */
    public function editAction($entity) {

        $editForm = $this->createForm(new InicialXType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        return $this->render('BackendBundle:InicialX:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ))
        ;
    }

    /**
     * Displays los detalles de un nivel inicial localizado en un establecimiento
     *
     * @Route("/{id}/show", name="oferta_educativa.inicialx.show")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"id"})
     */
    public function showAction(UnidadOferta $unidad_oferta) {

        $inicial_x = $unidad_oferta->getInicial();

        if ($inicial_x) {

            $volver = Destino::generateUrlDesdeSession($this->get('session'), $this->get('router'));

            return $this->render('OfertaEducativaBundle:InicialX:show.html.twig', array(
                        'unidad_oferta' => $unidad_oferta,
                        'inicial_x' => $inicial_x,
                        'volver' => $volver,
                    ))
            ;
        } else {
            // si no tiene el nivel inicial definido por su oferta se lo deriva a la dirección para crearlo
            return $this->redirect($this->generateUrl('backend_unidadoferta'));
        }
    }

    /**
     * Deletes a entity.
     *
     * @Route("/{id}/delete", name="backend.inicialx.delete")
     * @Method("post")
     * @ParamConverter("entity", class="OfertaEducativaBundle:InicialX")
     */
    public function deleteAction($entity) {
        //tiene que ir a deletear al habdler y ver a donde vuelve en caso afirmativo o negativo
//        
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
//        return $this->redirect($this->generateUrl('backend.inicialx'));
    }

    /**
     * Edits an existing entity.
     *
     * @Route("/{id}/update", name="backend.inicialx.update")
     * @Method("post")
     * @ParamConverter("entity", class="OfertaEducativaBundle:InicialX")
     */
    public function updateAction($entity) {

        $editForm = $this->createForm(new InicialXType(), $entity);

        $deleteForm = $this->createDeleteForm($entity->getId());

        $originalSalas = array();
        foreach ($entity->getSalas() as $sala) {
            $originalSalas[] = $sala;
        }

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {

            $respuesta = $this->getHandler()->actualizar($entity, $originalSalas);

            $tipo = ($respuesta->getCodigo() == 1) ? 'exito' : 'error';

            $this->get('session')->getFlashBag()->add($tipo, $respuesta->getMensaje());

            return $this->redirect($this->generateUrl('backend.inicialx.edit', array('id' => $entity->getId())));
        }

        return $this->render('BackendBundle:InicialX:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
