<?php

namespace Fd\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Fd\EstablecimientoBundle\Entity\EstablecimientoEdificio;



use Fd\BackendBundle\Form\AutoridadType;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\EstablecimientoBundle\Form\Filter\AutoridadFilterType;
use Fd\EstablecimientoBundle\Model\DatosAChoiceVisitador;
use Fd\TablaBundle\Entity\Cargo;

/**
 * Autoridad controller.
 *
 * @Route("/cargaagenda")
 */
class CargaAgendaController extends Controller {

    private $em;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * Muestra una damero de sedes y anexos para seleccionar uno y cargar la organizacion
     * 
     * @Route("/organizaciondamero", name="backend.cargaagenda.organizaciondamero")
     */
    public function OrganizacionDameroAction() {

        $sedes_anexos = $this->getEm()
                ->getRepository('EstablecimientoBundle:EstablecimientoEdificio')
                ->findSedesYAnexosOrdenados();

        return $this->render('BackendBundle:CargaOrganizacion:damero.html.twig', array(
                    'sedes_anexos' => $sedes_anexos,
                        )
        );
    }
    /**
     * Dada una sede/anexo muestra la tabla de dependencias para asignar desasignar
     */
    

}
