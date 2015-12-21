<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
use Fd\EstablecimientoBundle\Model\PlanillaSedesYAnexos;
use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;



/**
 * EstablecimientoEdificio controller.
 *
 * @Route("/establecimiento_edificio")
 */
class EstablecimientoEdificioController extends Controller {

    private $em;

    private function getEm() {
        if (is_null($this->em)) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * 
     * @Route("/sedes_anexos", name="establecimiento.establecimiento_edificio.sedes_anexos_salida_planilla")
     * @DownloadAs(filename="sedes_y_anexos.xls")
     */
    public function sedes_anexos_salida_planillaAction() {

        $establecimiento_edificios = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findSedesYAnexosOrdenados();
        
        //se crea el servicio para crear planillas
        $excelService = $this->get('phpexcel');

        // defino la planilla
        $planilla = new PlanillaSedesYAnexos($excelService, 'Listado de sedes y anexos', $establecimiento_edificios, $this->getEm() );
        
        //genero la planilla y devuelve un response
        $response = $planilla->generarPlanillaResponse();

        return $response;        

    }
    
}
