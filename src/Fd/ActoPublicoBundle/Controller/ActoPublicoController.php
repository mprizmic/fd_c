<?php

namespace Fd\ActoPublicoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Fd\ActoPublicoBundle\Entity\LogActoPublico;
use Fd\ActoPublicoBundle\Entity\ResumenMedia;
use Fd\ActoPublicoBundle\Model\ActoPublicoManager;
use Fd\ActoPublicoBundle\Util\Util;
use \PHPExcel_Shared_Date;
use \PHPExcel_Style_NumberFormat;

class ActoPublicoController extends Controller {

    private $em;
    private $planilla;

    private function getEm() {
        if (!$this->em) {
            $this->em = $this->getDoctrine()->getEntityManager();
        };
        return $this->em;
    }

    private function getRepository() {
        return $this->getEm()->getRepository('ActoPublicoBundle:ActoPublico');
    }

    private function setPlanilla($planilla) {
        $this->planilla = $planilla;
    }

    /**
     * @Route("/capturar", name="acto_publico_capturar") 
     */
    public function capturar_acto_mediaAction() {
        //Ruta hasta la capeta web
        $targetDir = $this->get('kernel')->getRootDir() . '/../web/actos/';

        //  $archivo = archivo.xlsx
        $archivo = $this->container->getParameter('fd.acto_publico.archivo_media');

//        $archivo = "Para_Publicar_4_otorgado.xls";
        $fileWithPath = $targetDir . $archivo;

        /**
         * capturar la planilla
         * devuelve un archivo cargado y un array con la fecha y el nro del acto 
         */
        $acto_publico = $this->capturar($fileWithPath);

        if ($this->hay_errores()) {
            return $this->redirect($this->generateUrl('acto_publico_captura_fracaso'));
        };

        //se emite las planilla resumen o la pagina resumen
        $llamados = $this->getEm()
                ->getRepository('ActoPublicoBundle:ResumenMedia')
                ->cargosVacantes();

        $el_mas_antiguo = $this->getEm()
                ->getRepository('ActoPublicoBundle:ResumenMedia')
                ->mas_antiguo();

        return $this->render('ActoPublicoBundle:ActoPublico:acto_publico.html.twig', array(
                    'acto_publico' => $acto_publico,
                    'llamados' => $llamados,
                    'el_mas_antiguo' => $el_mas_antiguo,
                ));
    }

    /**
     * chequea si la tabla de log de la captura tiene màs de un registro
     */
    private function hay_errores() {
        return $this->getEm()->getRepository('ActoPublicoBundle:LogActoPublico')->count() > 0 ? true : false;
    }

    /**
     * va grabando el archivo ResumenMedia con los cargos que quedaron vacantes
     * 
     * @param type $fileWithPath
     * @return type 
     */
    private function capturar($fileWithPath) {

        $acto_publico = array();

//        $acto_publico_manager = new ActoPublicoManager();
        //limpiar el log
        if (!$this->truncar_tabla('ActoPublicoBundle:LogActoPublico')) {
            return $acto_publico;
        };

        //limpiar el archivo resumen
        if (!$this->truncar_tabla('ActoPublicoBundle:ResumenMedia')) {
            $this->logguear(null, 'Problemas al borrar el archivo de resumen');
            return $acto_publico;
        };

        //cargo la planilla
        $objPHPExcel = $this->get('phpexcel')->createPHPExcelObject($fileWithPath);
        //esto era en la version anterior del bundle
//        $objPHPExcel = $this->get('xls.load_xls5')->load($fileWithPath);

        // Activa la primera hoja
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        $this->setPlanilla($objWorksheet);

        // numero de filas
        $highestRow = $objWorksheet->getHighestRow();

        //captura del numero de acto
        $fila = 2;
        $acto = $this->leer('A', $fila);
        $acto_publico['numero'] = $acto;

        //captura de fecha
        $fila = 3;
        $fecha = substr($this->leer('A', $fila), -8);
        $acto_publico['fecha'] = $fecha;

        /////////////////////////////////////
        //aca empieza el primer cargo
        //////////////////////////////////////////
        $fila = 6;
        $cargo = $this->leer('A', $fila);
        if ($cargo !== 'CARGO' and $cargo !== 'H-CÁTEDRA') {
            $this->logguear($fila, 'El CARGO no está donde se esperaba');
            return $acto_publico;
        };
        $cargo = $this->leer('B', $fila);

        while ($fila < $highestRow) {

            $marcador = $this->leer('A', $fila);

            if ($marcador == 'Escuela:') {

                //capturo un llamado
                $llamado = $this->capturar_llamado($fila);

                //si se capturo un vacante, se procesa, sino se ignora
                if ($llamado) {
                    $llamado->setCargo($cargo);
                    $llamado->setSlugCargo(Util::getSlug($cargo));
                    $llamado->setNumero($acto);
                    $llamado->setFecha($fecha);

                    //grabo un llamado
                    $this->getEm()->persist($llamado);
                    $this->getEm()->flush();
                };
                //cada escuela tiene 11 filas
                $fila = $fila + 11;
            };

            if ($marcador == 'CARGO' or $marcador == 'H-CÁTEDRA') {
                $cargo = $this->leer('B', $fila);
                ;
            };

            $fila = $fila + 1;
        }
        return $acto_publico;
    }

    private function truncar_tabla($archivo) {
        try {
            $this->getEm()->getRepository($archivo)->truncar();
        } catch (Exception $e) {
            return false;
        };
        return true;
    }

    /**
     * Leer una celda calculada y le saca blancos atrás y adelante 
     */
    private function leer($celda, $fila) {
        return trim($this->planilla->getCell($celda . $fila)->getCalculatedValue());
    }

    /*
     * Captura los datos de un solo llamado
     */

    public function capturar_llamado($fila) {
        $un_llamado = new ResumenMedia();

        //si quedo vacante o no
        $tomado = $this->leer('E', $fila - 1);
        if ($tomado == '') {
            //le la columna de al lado
            $tomado = $this->leer('F', $fila - 1);
            if ($tomado == '') {
                $tomado = $this->leer('G', $fila - 1);
                if ($tomado == '') {
                    $tomado = $this->leer('D', $fila - 1);
                    if ($tomado == '') {
                        $this->logguear($fila - 1, 'Se esperaba un dato y se encontró blanco');
                        return false;
                    };
                };
            };
        };
        if ($tomado !== 'VACANTE') {
            return false;
        }
        //capturo establecimiento
        $establecimiento = $this->leer('B', $fila);
        $un_llamado->setEstablecimiento($establecimiento);

        //capturo cargo/asignatura
        $fila = $fila + 4;
        $cargo_vacante = $this->leer('B', $fila);
        $un_llamado->setCargoVacante($cargo_vacante);

        //capturo horario y horas . Es un campo string
        $fila = $fila + 1;
        $cantidad_horas_string = $this->leer('B', $fila);
        $un_llamado->setCantidadHorasString($cantidad_horas_string);
        //de esta columna tomo el dato calculado por mi
        $cantidad_horas = $this->leer('I', $fila);
        $un_llamado->setCantidadHoras($cantidad_horas);
        $un_llamado->setFila($fila);

        //capturo horario
        $fila = $fila + 3;
        $lunes = $this->leer('A', $fila);
        $un_llamado->setHorarioLunes($lunes);
        $martes = $this->leer('B', $fila);
        $un_llamado->setHorarioMartes($martes);
        $miercoles = $this->leer('C', $fila);
        $un_llamado->setHorarioMiercoles($miercoles);
        $jueves = $this->leer('D', $fila);
        $un_llamado->setHorarioJueves($jueves);
        $viernes = $this->leer('E', $fila);
        $un_llamado->setHorarioViernes($viernes);

        //
        //capuro fecha iniciacion
        $fila = $fila + 1;
        $fechaIniciacion = $this->leer('C', $fila);
        $fecha = $this->rectificacionFechaExcel($fechaIniciacion);
        //el formato de la fecha está mal
        if (!$fecha) {
            $this->logguear($fila, 'La fecha de iniciación del cargo es incoherente');
            return false;
        }
        $un_llamado->setFechaIniciacion($fecha);

        //capturo fecha terminacion
        /**
         * aca puede venir S/T o cualquier cosa que no sea una fecha. chequear con expresion regular 
         */
        $posible_fechaTerminacion = $this->leer('G', $fila);
        if ($posible_fechaTerminacion) {
            $fecha = $this->dateToString($posible_fechaTerminacion);
            $un_llamado->setFechaTerminacion($fecha);
        };

        return $un_llamado;
    }

    public function rectificacionFechaExcel($fecha) {
        //devuelve un string con formato de fecha
        $fecha_con_formato = $this->dateToString($fecha);
        return \DateTime::createFromFormat('d-m-Y', $fecha_con_formato);
    }

    public function dateToString($fecha) {
        return PHPExcel_Style_NumberFormat::toFormattedString($fecha, 'DD-MM-YYYY');
    }

    public function logguear($fila, $texto) {
        $mensaje = '';
        if ($fila) {
            $mensaje = 'En la fila ' . $fila . ', ';
        };
        $mensaje = $mensaje . $texto;
        $problema = new LogActoPublico();
        $problema->setFecha(new \DateTime());
        $problema->setLog($mensaje);
        $this->getEm()->persist($problema);
        $this->getEm()->flush();

        return;
    }

    /**
     * @Route("/captura_fracaso", name="acto_publico_captura_fracaso")
     */
    public function captura_fracasoAction() {
        $problemas = $this->getEm()->getRepository('ActoPublicoBundle:LogActoPublico')->findAll();

        return $this->render('ActoPublicoBundle:ActoPublico:captura_fracaso.html.twig', array(
                    'problemas' => $problemas,
                ));
    }

    /**
     * a partir del cargo toma los datos de ese cargo y genera las 2 tablas resumen
     * 
     * @Route("/captura_resumen_un_cargo/{slug_cargo}", name="captura_resumen_un_cargo")
     * @param type $cargo 
     */
    public function resumen_media_un_cargo($slug_cargo) {

        //genero los datos para el cuadro de cargos por fecha
        $por_fecha = $this->getEm()->getRepository('ActoPublicoBundle:ResumenMedia')->findBy(array(
            'slug_cargo' => $slug_cargo,
                ), array(
            'fecha_iniciacion' => 'ASC'
                )
        );

        //genero los datos para el cuadro de cargos por establecimiento por cantidad
        $por_cantidad = $this->getEm()->getRepository('ActoPublicoBundle:ResumenMedia')
                ->cargosVacantesSeleccionados($slug_cargo)
        ;

        //preparo datos para encabezado
        //Todos los registros del query traen estos datos
        $acto_publico['numero'] = $por_fecha[0]->getNumero();
        $acto_publico['fecha'] = $por_fecha[0]->getFecha();
        $acto_publico['cargo'] = $por_fecha[0]->getCargo();

        return $this->render('ActoPublicoBundle:ActoPublico:media_cargo_detalle.html.twig', array(
                    'acto_publico' => $acto_publico,
                    'por_fecha' => $por_fecha,
                    'por_cantidad' => $por_cantidad,
                ));
    }

}
