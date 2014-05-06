<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/inicial")
 */
class InicialController extends Controller
{
    /**
     * @Route("/nomina", name="inicial_nomina")
     */
    public function nominaAction(){
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_largo'));
        
//        establecimientos paginados
        $establecimientos = 
                $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                ->qyAllNivelOrdenado('Ini','orden')
                ->getResult();
        
        return $this->render('EstablecimientoBundle:Inicial:nomina.html.twig', array(
            'establecimientos'=>$establecimientos,
            ));
    }
}
