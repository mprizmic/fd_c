<?php

namespace Fd\OfertaEducativaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Fd\OfertaEducativaBundle\Entity\InicialX;
use Fd\OfertaEducativaBundle\Form\InicialXType;
use Fd\OfertaEducativaBundle\Model\InicialXHandler;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\Respuesta;

/**
 * @Route("/inicial_x")
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
     * Displays los detalles de un nivel inicial localizado en un establecimiento
     *
     * @Route("/{id}/show/{establecimiento_id}", name="oferta_educativa.inicialx.show")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"id"})
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id":"establecimiento_id"})
     */
    public function showAction(UnidadOferta $unidad_oferta, $establecimiento) {

//        $secundario_x = $unidad_oferta->getSecundario();
//
//        if ($secundario_x) {
//
//            $ruta = $this->get('session')->get('ruta_completa');
//            $params = $this->get('session')->get('parametros');
//
//            $volver = $this->generateUrl($ruta, $params);
//
//            return $this->render('OfertaEducativaBundle:SecundarioX:show.html.twig', array(
//                        'unidad_oferta' => $unidad_oferta,
//                        'secundario_x' => $secundario_x,
////                        'establecimiento_id' => $establecimiento_id,
//                        'volver' => $volver,
//                    ))
//            ;
//        } else {
//            // si no tiene el nivel medio definido por su oferta se lo deriva a la dirección para crearlo
//            return $this->redirect($this->generateUrl('backend_unidadoferta'));
//        }
    }

}
