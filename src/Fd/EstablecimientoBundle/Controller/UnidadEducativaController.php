<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Fd\EstablecimientoBundle\Entity\Establecimiento;

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
}