<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/medio")
 */
class MedioController extends Controller
{
    /**
     * @Route("/nomina", name="medio_nomina")
     */
    public function nominaAction(){

        $establecimientos = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->qyAllNivelOrdenado('Med','orden') 
                ->getResult();
        
        return $this->render('EstablecimientoBundle:Default:nomina_nivel.html.twig', array(
            'establecimientos'=>$establecimientos,
            'nivel'=>'medio',
            ));
    }
}
