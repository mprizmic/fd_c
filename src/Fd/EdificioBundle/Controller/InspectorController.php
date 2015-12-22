<?php

namespace Fd\EdificioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fd\EdificioBundle\Model\PlanillaInspectoresInfraestructura;
use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

/**
 * Inspector controller.
 *
 * @Route("/inspector")
 */
class InspectorController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepositorio() {
        return $this->getEm()->getRepository('EdificioBundle:Inspector');
    }

    /**
     * @Route("/listado_inspectores", name="edificio.inspector.listado_inspectores")
     * @DownloadAs(filename="inspectores.xls")
     */
    public function listado_inspectoresAction() {
        
        $edificio_establecimientos = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->qbInspectores()
                ->getQuery()
                ->getResult();
        
        //se crea el servicio para crear planillas
        $excelService = $this->get('phpexcel');

        // defino la planilla
        $planilla = new PlanillaInspectoresInfraestructura($excelService, 'Listado de inspectores de infraestructura', $edificio_establecimientos, $this->getEm() );
        
//        $planilla->setTitulo('Listado de supervisores de infraestructura');

        //genero la planilla y devuelve un response
        $response = $planilla->generarPlanillaResponse();

        return $response;        
    }

}
