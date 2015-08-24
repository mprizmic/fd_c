<?php

namespace Fd\EstablecimientoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\EstablecimientoBundle\Entity\Localizacion;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\BackendBundle\Form\LocalizacionType;
use Fd\EdificioBundle\Form\Type\DomiciliosType;
use Fd\EdificioBundle\Form\Type\UnDomicilioType;

use Fd\EstablecimientoBundle\Annotation\DownloadAs;
use Fd\EstablecimientoBundle\EventListener\DownloadListener;
use Fd\EstablecimientoBundle\Model\PlanillaMatriculaDeLocalizacion;
use Fd\EstablecimientoBundle\Utilities\PlanillaDeCalculo;

/**
 * Localizacion controller.
 *
 * @Route("/localizacion")
 */
class LocalizacionController extends Controller {

    private $em;

    /**
     * devuelve el EntityManager
     */
    public function getEm() {
        if ($this->em == null) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    /**
     * Muestra el cuadro de matricula de cada carrera que se imparte en la localizacion.
     * La localizacion corresponde a un terciario 
     * 
     * @Route("/cuadro_matricula/{localizacion_id}/{tipo}", name="sede_anexo_cuadro_matricula")
     * @Template("EstablecimientoBundle:Localizacion:cuadro_matricula.html.twig")
     * @ParamConverter("localizacion", class="EstablecimientoBundle:Localizacion", options={"id"="localizacion_id"})
     */
    public function cuadro_matriculaAction(Localizacion $localizacion, $tipo) {

        $hoy = date("Y");
        $anio_desde = $hoy - 2;

        //todas las carreras de una localizacion de una unidad educativo terciario
        $unidad_oferta_carreras = $this->getEm()->getRepository('EstablecimientoBundle:Localizacion')
                ->findCarreras($localizacion, true);

        foreach ($unidad_oferta_carreras as $key => $unidad_oferta) {
            $carrera = $unidad_oferta->getOfertas()->getCarrera();
            $una_carrera['nombre'] = $carrera->getNombre() . ' - ' . $carrera->getEstado();
            $una_carrera['id'] = $carrera->getId();
            $una_carrera['cohortes'] = array();

            $cohortes = $unidad_oferta->getCohortes();

            foreach ($cohortes as $key => $cohorte) {
                $anio = $cohorte->getAnio();
                if ($anio >= $anio_desde and $anio <= $hoy) {
                    $una_carrera['cohortes'][$anio]['ingresantes'] = $cohorte->getMatriculaIngresantes();
                    $una_carrera['cohortes'][$anio]['matricula'] = $cohorte->getMatricula();
                    $una_carrera['cohortes'][$anio]['egreso'] = $cohorte->getEgreso();
                }
            }
            $salida[] = $una_carrera;
        }

        return array(
            'unidades_ofertas' => null,
            'establecimiento_edificio' => $localizacion->getEstablecimientoEdificio(),
            'salida' => $salida,
            'anio_desde' => $anio_desde,
            'anio_hasta' => $hoy,
        );
    }

    /**
     * Emite un cuadro de matricula de todos los niveles de todas las sedes/anexos tomado de la matricula de la tabla localizacion
     * 
     * @Route("/matricula_de_localizacion", name="establecimiento.localizacion.matricula_de_localizacion")
     * @DownloadAs(filename="matricula.xls")
     */
    public function listado_matricula_localizacionAction() {
        $sql = " 
        select 
            e.apodo as establecimiento
            ,e.cue as cue
            ,ee.cue_anexo as anexo
            ,ee.nombre as nombre_anexo
            ,n.nombre as nivel
            ,loc.matricula as matricula
            ,com.numero as comuna
            ,dies.numero as DE
                from Fd.establecimiento e
                inner join Fd.establecimiento_edificio ee on ee.establecimientos_id=e.id
                inner join Fd.edificio ed on ed.id=ee.edificios_id
                inner join Fd.localizacion loc on loc.establecimiento_edificio_id=ee.id
                inner join Fd.unidad_educativa ue on loc.unidad_educativa_id=ue.id
                inner join Fd.nivel n on n.id=ue.nivel_id
                inner join Fd.comuna com on com.id=ed.comuna_id
                inner join Fd.distrito_escolar dies on dies.id=ed.distrito_escolar_id
                    where ee.cue_anexo <> '99'
                    order by e.orden, ee.cue_anexo, n.orden;
        ";

        $stmt = $this->getEm()->getConnection()->prepare($sql);
        
        $stmt->execute();
        
        $resultado = $stmt->fetchAll();
        
        //se crea el servicio para crear planillas
        $excelService = $this->get('phpexcel');

        // defino la planilla
        $planilla = new PlanillaMatriculaDeLocalizacion($excelService, 'Listado de matrícula', $resultado);

        //genero la planilla y devuelve un response
        $response = $planilla->generarPlanillaResponse();
        
        return $response;
        
    }

}
