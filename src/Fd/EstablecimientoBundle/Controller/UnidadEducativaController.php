<?php

namespace Fd\EstablecimientoBundle\Controller;

use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\TablaBundle\Entity\Nivel;

/**
 * @Route("/unidad_educativa")
 */
class UnidadEducativaController extends Controller
{
    /**
     * Lista de unidades_educativas para un combo formateados en json
     * 
     * Dado un establecimiento_edificio, devuelve la lista de unidades educativas del establecimiento que ahi funcionan
     * 
     * @Route("/combo/{establecimiento_id}", name="unidad_educativa_combo")
     * @ParamConverter("establecimiento_edificio", class="EstablecimientoBundle:EstablecimientoEdificio", options={"id":"establecimiento_id"} )
     */
    public function comboAction($establecimiento_edificio) {

        $localizaciones = $establecimiento_edificio->getLocalizacion();

        foreach ($localizaciones as $localizacion) {
            $elemento['value'] = $localizacion->getId();
            $elemento['text'] = $localizacion->getUnidadEducativa()->getNivel()->getNombre();
            $resultado[] = $elemento;
        }
        
        usort($resultado, function($a, $b){ return $a['value'] > $b['value']; });
        
        $response = new Response();
        $response->setContent(json_encode($resultado));

        return $response;
    }    
}