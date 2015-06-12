<?php

namespace Fd\OfertaEducativaBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;
use Fd\EstablecimientoBundle\Model\UnidadOfertaHandler;
use Fd\EstablecimientoBundle\Model\CarreraUnidadOfertaHandler;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Model\CarreraManager;
use Fd\TablaBundle\Model\EstadoCarreraManager;
use Fd\TablaBundle\Model\TipoFormacionManager;
use Fd\TablaBundle\Model\TurnoManager;

class UploadOfertaTerciarioCommand extends ContainerAwareCommand {

    public $planilla;

    protected function configure() {
        $this
                ->setName('fd:oferta_educativa:upload_carreras')
                ->setDescription('Captura un excel con oferta de carreras')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        // actualizar los estados de los existentes       'update Fd.carrera car set car.estado_id=4 where car.id<>71 and car.id<>72';
        //el container esta disponible con $this->getContainer()->get('servicio');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        //Ruta hasta la capeta web
        $targetDir = $this->getContainer()->get('kernel')->getRootDir() . '/../web/documentos/';

        //  $archivo = archivo.xlsx
        $archivo = 'oferta que se va aprobando para 2015.xls';

        $fileWithPath = $targetDir . $archivo;

        //cargo la planilla
        $objPHPExcel = $this->getContainer()->get('phpexcel')->createPHPExcelObject($fileWithPath);

        // Activa la primera hoja
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);


        // numero de filas
        $highestRow = $objWorksheet->getHighestRow();

        $output->writeln('última línea: ' . $highestRow);

        //guardo la planilla
        $this->planilla = $objWorksheet;

        $fila = 2;

        //leo la primera
        $linea = $this->leer($fila);

        //creo manejadores
        $tipo_formacion_manager = new TipoFormacionManager($em);
        $carrera_manager = new CarreraManager($em);
        $estado_carrera_manager = new EstadoCarreraManager($em);
        $uo_handler = new UnidadOfertaHandler($em, 'Ter');
        $turno_manager = new TurnoManager($em);

        while ($fila <= $highestRow) {

            $carrera_anterior = $linea['carrera'];

            //genero carrera y oferta educativa
            $carrera = new Carrera();
            $carrera->setNombre($linea['carrera']);
            $carrera->setDuracion($linea['duracion']);
            $carrera->setEstado($estado_carrera_manager->crearLleno());
            $carrera->setFormacion($tipo_formacion_manager->crearLleno());

            //se persiste la carrera y la oferta educativa
            $carrera_manager->crear($carrera);

            while ($fila <= $highestRow and $carrera_anterior == $linea['carrera']) {

                $establecimiento_anterior = $linea['establecimiento'];
                $establecimiento = $em->getRepository('EstablecimientoBundle:Establecimiento')->find($linea['id']);

//		genero unidad_oferta
                $respuesta = $uo_handler->crear($establecimiento->getTerciario(), $carrera->getOferta());
                $unidad_oferta = $em->getReference('EstablecimientoBundle:UnidadOferta', $respuesta->getClaveNueva());

                $turnos = new ArrayCollection();

                while ($fila <= $highestRow and $carrera_anterior == $linea['carrera'] and $establecimiento_anterior == $linea['establecimiento']) {

                    $turno = $turno_manager->crearLleno('T' . $linea['turno']);

                    $unidadoferta_turno = new UnidadOfertaTurno();
                    $unidadoferta_turno->setTurno($turno);
                    $unidadoferta_turno->setUnidadOferta($unidad_oferta);

                    $turnos->add($unidadoferta_turno);


                    $fila = $fila + 1;
                    $linea = $this->leer($fila);
                };
                //actualizar los turnos de la unidad_oferta
                //genero turno

                $unidad_oferta->setTurnos($turnos);

                $uo_handler->actualizar($unidad_oferta, array());
            }
        }

        $output->writeln('terminó');

        return;
    }

    /**
     * Lee de a una celda y carga en un array
     */
    private function leer($fila) {

        $linea['carrera'] = trim($this->planilla->getCell('C' . $fila)->getCalculatedValue());
        $linea['establecimiento'] = trim($this->planilla->getCell('B' . $fila)->getCalculatedValue());
        $linea['id'] = trim($this->planilla->getCell('A' . $fila)->getCalculatedValue());
        $linea['turno'] = trim($this->planilla->getCell('F' . $fila)->getCalculatedValue());
        $linea['duracion'] = trim($this->planilla->getCell('E' . $fila)->getCalculatedValue());

        return $linea;
    }

}
