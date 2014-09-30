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
     * @Route("/unidad_educativa_de_un_cue/{establecimiento_id}", name="unidad_educativa_de_un_cue")
     */
    public function de_un_cueAction($establecimiento_id) {
        $em = $this->getDoctrine()->getEntityManager();
        
        
        $unidades_educativas = $em->getRepository('EstablecimientoBundle:UnidadEducativa')->findDeUnCue($establecimiento_id);
        
        $establecimiento = $unidades_educativas[0]->getEstablecimiento();
                
        return $this->render('EstablecimientoBundle:Default:unidad_educativa_de_un_cue.html.twig', array(
            'unidades_educativas'=>$unidades_educativas,
            'establecimiento'=>$establecimiento,
            ));
    }
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