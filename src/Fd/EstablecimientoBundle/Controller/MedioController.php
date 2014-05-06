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
        $paginador = $this->get('ideup.simple_paginator');
        $paginador->setItemsPerPage($this->container->getParameter('fd.grilla_largo'));
        
//        establecimientos paginados
        $establecimientos = $paginador->paginate(
                $this->getDoctrine()->getEntityManager()->getRepository('EstablecimientoBundle:Establecimiento')
                ->qyAllNivelOrdenado('Med','orden') 
                )->getResult();
        
        return $this->render('EstablecimientoBundle:Medio:nomina.html.twig', array(
            'establecimientos'=>$establecimientos,
            ));
    }
}
