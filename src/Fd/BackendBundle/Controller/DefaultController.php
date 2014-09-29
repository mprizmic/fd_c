<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * muestra la portada del backend
     * 
     * @Route("/portada")
     * @Template()
     */
    public function portadaAction()
    {
        $tablas = $this->getDoctrine()->getRepository('BackendBundle:Portada')->findAllOrdenado('tabla');
        return array(
            'tablas' => $tablas,
        );
    }

    /**
     * @Route("/index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
