<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
use Fd\EstablecimientoBundle\Model\PlanillaNominaNivelMedio;
use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

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
    /**
     * @Route("/nomina_planilla", name="medio_nomina_planilla")
     * @DownloadAs(filename="establecimientos_con_nivel_medio.xls")
     */
    public function nominaPlanillaAction(){

        $establecimientos = $this->getDoctrine()
                ->getEntityManager()
                ->getRepository('EstablecimientoBundle:Establecimiento')
                ->qyAllNivelOrdenado('Med','orden') 
                ->getResult();
        
        //se crea el servicio para crear planillas
        $excelService = $this->get('phpexcel');

        // defino la planilla
        $planilla = new PlanillaNominaNivelMedio($excelService, 'Listado de establecimientos que imparten Nivel Medio', $establecimientos );
        
        //genero la planilla y devuelve un response
        $response = $planilla->generarPlanillaResponse();

        return $response;           
        
//        return $this->render('EstablecimientoBundle:Default:nomina_nivel.html.twig', array(
//            'establecimientos'=>$establecimientos,
//            'nivel'=>'medio',
//            ));
    }    
}
