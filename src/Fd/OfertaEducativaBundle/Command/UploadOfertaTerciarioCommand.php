<?php

namespace Fd\OfertaEducativaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

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

//        $this->logguear(null, 'Problemas al borrar el archivo de resumen');
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
//
        while ($fila <= $highestRow) {

            $carrera_anterior = $linea['carrera'];
//	
            //genero carrera y oferta educativa
//
            while ($fila <= $highestRow or $carrera_anterior == $linea['carrera']) {
//
                $establecimiento_anterior = $linea['establecimiento'];
//
//		genero unidad_oferta
//
                while ($fila < $highestRow or $carrera_anterior == $linea['carrera'] or $establecimiento_anterior == $linea['establecimiento']) {
//			
//			genero turno
//
                    $fila = $fila + 1;
                    $linea = $this->leer($fila);
                }
            }
        }

        $output->writeln('terminó');

        return;
    }

    /**
     * Leer una celda calculada y le saca blancos atrás y adelante 
     */
    private function leer($fila) {
        return trim($this->planilla->getCell($celda . $fila)->getCalculatedValue());
    }

    public function rectificacionFechaExcel($fecha) {
        //devuelve un string con formato de fecha
        $fecha_con_formato = $this->dateToString($fecha);
        return \DateTime::createFromFormat('d-m-Y', $fecha_con_formato);
        ;
    }

    public function dateToString($fecha) {
        return PHPExcel_Style_NumberFormat::toFormattedString($fecha, 'DD-MM-YYYY');
    }

}
