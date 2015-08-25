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
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;

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
     * Displays los detalles de un nivel inicial localizado en un establecimiento
     *
     * @Route("/{id}/show", name="oferta_educativa.inicialx.show")
     * @ParamConverter("unidad_oferta", class="EstablecimientoBundle:UnidadOferta", options={"id":"id"})
     */
    public function showAction(UnidadOferta $unidad_oferta) {

        $inicial_x = $unidad_oferta->getInicial();

        if ($inicial_x) {

            $ruta = $this->get('session')->get('ruta_completa');
            $params = $this->get('session')->get('parametros');

            $volver = $this->generateUrl($ruta, $params);

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

}
