<?php

namespace Fd\EstablecimientoBundle\Controller;

use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/unidad_educativa")
 */
class UnidadEducativaController extends Controller
{
    /**
     * Lista de unidades_educativas para un combo formateados en json
     * Se puede filtrar por establecimiento
     * 
     * @Route("/combo/{establecimiento_id}", name="unidad_educativa_combo")
     * @ParamConverter("establecimiento", class="EstablecimientoBundle:Establecimiento", options={"id"="establecimiento_id"} )
     */
    public function comboAction($establecimiento) {

        $unidades_educativas = $establecimiento->getUnidadesEducativas();

        foreach ($unidades_educativas as $unidad_educativa) {
            $resultado[] = $unidad_educativa->aJson();
        }

        $response = new Response();
        $response->setContent(json_encode($resultado));

        return $response;
    }    
}