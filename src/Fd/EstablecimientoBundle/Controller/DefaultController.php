<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Goutte\Client;

class DefaultController extends Controller {

    
    /**
     * @Route("/listados",  name="listados")
     */
    public function listadosAction(){
        return $this->render("EstablecimientoBundle:Default:listados.html.twig");
    }
    /**
     * avisos de los avances del sistema o de la carga pendiente
     * @Route("/avisos", name="avisos")
     */
    public function avisosAction() {
        $avisos = $this->getDoctrine()->getEntityManager()->getRepository("TablaBundle:Aviso")->findBy(array('activo' => true), array('fecha'=>'desc'));

        if (count($avisos) > 0) {
            return $this->render('EstablecimientoBundle:Default:avisos.html.twig', array(
                        'avisos' => $avisos,
            ));
        } else {
            return $this->redirect($this->generateUrl('establecimiento_damero'));
        }
    }
    
    /**
     * @Route("/",  name="portada")
     */
    public function portadaAction() {
        return $this->render('EstablecimientoBundle:Default:portada.html.twig');
    }

    /**
     * @Route("/acerca_de", name="acerca_de")
     * @Template("EstablecimientoBundle:Default:acerca_de.html.twig")
     */
    public function acerca_deAction() {
        return array();
    }

    /**
     * @Route("/contacto", name="contacto")
     * @Template("EstablecimientoBundle:Default:contacto.html.twig")
     */
    public function contactoAction() {
        return array();
    }

    /**
     * @Route("/glosario", name="glosario")
     * @Template("EstablecimientoBundle:Default:glosario.html.twig")
     */
    public function glosarioAction() {
        $terminos = $this->getDoctrine()->getEntityManager()->getRepository("TablaBundle:Glosario")->findAll();
        return array(
            'terminos' => $terminos,
        );
    }

    /**
     * @Route("/avances_del_sistema", name="avances_del_sistema")
     * @Template("EstablecimientoBundle:Default:avances_del_sistema.html.twig")
     */
    public function avances_del_sistemaAction() {
        return array();
    }

    /**
     * @Route("/en_desarrollo", name="en_desarrollo")
     * @Template("::en_desarrollo.html.twig")
     */
    public function en_desarrolloAction() {
        return array();
    }

    /**
     * @Route("/cumpleanios", name="cumpleanios")
     */
    public function cumpleaniosAction() {

        //recupera los usuarios ordenados por fecha de nacimiento 
        $usuarios = $this->getDoctrine()->getEntityManager()->getRepository("UsuarioBundle:Usuario")->findCumpleanios();

        //al resultado hay que extraerle el mes y el dia 
        foreach ($usuarios as $key => $value) {
            $resultado[$key]['apellido'] = $value['apellido'] . ', ' . $value['nombre'];

            //tratamiento de la fecha que viene como una sarta con formato yyyy-mm-dd hh:mm:ss
            $resultado[$key]['fecha'] = isset($value['fecha_nacimiento']) ? $value['fecha_nacimiento']->format('m-d') : '';
        }

        //sort por fecha (mm-dd)
        $ordenar = function ($elemento1, $elemento2) {
            //Si son iguales se devuelve 0
            if ($elemento1["fecha"] == $elemento2["fecha"])
                return 0;
            //Si elemento1 > 2 se devuelve 1 y por lo contrario -1
            if ($elemento1["fecha"] > $elemento2["fecha"])
                return 1;
            return -1;
        };

        usort($resultado, $ordenar);

        return $this->render("EstablecimientoBundle:Default:cumpleanios.html.twig", array(
                    'usuarios' => $resultado,
                ))
        ;
    }
    /**
     * @Route("/frase", name="frases")
     */
    public function frasesAction(){
        $frases = $this->getDoctrine()->getEntityManager()->getRepository("TablaBundle:Frase")->findBy(array(), array('fecha'=>'desc'));

        if (count($frases) > 0) {
            return $this->render('EstablecimientoBundle:Default:frases.html.twig', array(
                        'frases' => $frases,
            ));
        } else {
            return $this->redirect($this->generateUrl('establecimiento_damero'));
        }        
    }

}
