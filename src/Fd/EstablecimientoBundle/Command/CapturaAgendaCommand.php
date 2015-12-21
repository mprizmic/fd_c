<?php

/**
 * sf sf:a:cap --archivo=ens1.xls --force
 * 
 */

namespace Fd\EstablecimientoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\EstablecimientoBundle\Entity\OrganizacionInterna;
use Fd\EstablecimientoBundle\Entity\PlantelEstablecimiento;
use Fd\EstablecimientoBundle\Entity\Autoridad;

class CapturaAgendaCommand extends ContainerAwareCommand {

    public $dependencia_anterior;

    protected function configure() {
        
        $this
                ->setName('fd:agenda:captura')
                ->setDescription('Captura planilla excell con la agenda de un establecimiento')
//                ->addArgument('archivo', InputArgument::REQUIRED, 'archivo a procesar?')
                ->addOption('archivo', null, InputOption::VALUE_REQUIRED, 'archivo a procesar sin extensión')
                ->addOption('force', null, InputOption::VALUE_NONE, 'si se pone se graba')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {


        if ($input->getOption('force')) {
            $flush = true;
            
        } else {
            $flush = false;
        }
        
        $output->writeln($flush ? '***********************************graba':'********************************NO GRABA');



        //el container esta disponible con $this->getContainer()->get('servicio');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        //Ruta hasta la capeta del proyecto
        $targetDir = $this->getContainer()->get('kernel')->getRootDir() . '/../';

        //  $archivo = archivo.xlsx
//        $dialog = $this->getHelperSet()->get('dialog');
        
//        $archivo = $dialog->ask($output, 'Nombre del archivo a procesar (con extensión): ', 'nombre_default.xls');
//        $archivo = 'ens 1.xls';

        $archivo = $input->getOption('archivo');
        
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

        //leo la primera
        $x_establecimiento = trim($this->planilla->getCell('A1')->getCalculatedValue());

        $output->writeln($x_establecimiento);

        $establecimiento = $em->getRepository('EstablecimientoBundle:Establecimiento')
                ->findOneBy(array('apodo' => $x_establecimiento));

        if (!$establecimiento) {
            $output->writeln('no se reconoció al establecimiento');
            return;
        }

        $establecimiento_edificio = $establecimiento->getEdificioPrincipal();

        $fila = 2;

        //creo manejadores

        $linea = $this->leer($fila);

        while ($fila <= $highestRow) {

            $this->dependencia_anterior = $linea['dependencia'];

            $dependencia = $em->getRepository('TablaBundle:Dependencia')
                    ->findOneBy(array(
                'nombre' => $linea['dependencia'],
            ));

            if (!$dependencia) {
                $output->writeln('No coincide el nombre de dependencia');
                die();
            }

            //grabo la dependencia. tabla ORGANIZACION_INTERNA
            $oi = $em->getRepository('EstablecimientoBundle:OrganizacionInterna')
                    ->findOneBy(array(
                'establecimiento' => $establecimiento_edificio,
                'dependencia' => $dependencia,
            ));

            if ($oi) {
                //grabo el TE 
                $oi->setTe($linea['te_dep']);
                $em->persist($oi);

                $output->writeln('**************oi actualizado ' . $linea['te_dep']);
            } else {
                //creo registro en organización_interna
                $oi = new OrganizacionInterna();
                $oi->setEstablecimiento($establecimiento_edificio);
                $oi->setDependencia($dependencia);
                $oi->setTe($linea['te_dep']);

                $output->writeln('oi creado');
            };


            while ($fila <= $highestRow and $this->dependencia_anterior == $linea['dependencia']) {


                $output->writeln($fila . ': ' . $linea['dependencia']);
                $output->writeln($fila . ': ' . $linea['te_dep']);
                $output->writeln($fila . ': ' . $linea['cargo']);
                $output->writeln($fila . ': ' . $linea['nombre']);
                $output->writeln($fila . ': ' . $linea['te_part']);
                $output->writeln($fila . ': ' . $linea['celular']);
                $output->writeln($fila . ': ' . $linea['email']);


                //verifico el cargo
                $cargo = $em->getRepository('TablaBundle:Cargo')
                        ->findOneBy(array(
                    'nombre' => $linea['cargo'],
                ));

                if (!$cargo) {
                    $output->writeln('*****************no está el cargo');

                    die();
                }

                //actualizo tabla PLANTEL. la borre entera antes de procesar
                $pl = new PlantelEstablecimiento();
                $pl->setCargo($cargo);
                $pl->setOrganizacion($oi);
                $em->persist($pl);

                //actualizo tabla AUTORIDAD. la borré entera antes de procesar

                $tiene_coma = strpos($linea['nombre'], ",");

                if ($tiene_coma === false) {
                    list($apellido, $nombre) = explode(" ", $linea['nombre']);
                } else {
                    list($apellido, $nombre) = explode(",", $linea['nombre']);
                };
                $output->writeln($apellido . ', ' . $nombre . ':');

                $autoridad = new Autoridad();
                $autoridad->setApellido($apellido);
                $autoridad->setCargo($pl);
                $autoridad->setCelular($linea['celular']);
                $autoridad->setEmail($linea['email']);
                $autoridad->setNombre($nombre);
                $autoridad->setTeParticular($linea['te_part']);

                $em->persist($autoridad);

                //leo fila siguiente
                $fila = $fila + 1;
                $linea = $this->leer($fila);
            };
        }

        $output->writeln('terminó y procesó');
        
        if ($flush){
            $em->flush();
        }
        
        $output->writeln($flush ? '***********************************graba':'********************************NO GRABA');

        return;
    }

    /**
     * Lee de a una celda y carga en un array
     */
    private function leer($fila) {

        $dependencia = trim($this->planilla->getCell('A' . $fila)->getCalculatedValue());
        $linea['dependencia'] = ($dependencia) ? $dependencia : $this->dependencia_anterior;
        $linea['te_dep'] = trim($this->planilla->getCell('B' . $fila)->getCalculatedValue());
        $linea['cargo'] = trim($this->planilla->getCell('C' . $fila)->getCalculatedValue());
        $linea['nombre'] = trim($this->planilla->getCell('E' . $fila)->getCalculatedValue());
        $linea['te_part'] = trim($this->planilla->getCell('F' . $fila)->getCalculatedValue());
        $linea['celular'] = trim($this->planilla->getCell('G' . $fila)->getCalculatedValue());
        $linea['email'] = trim($this->planilla->getCell('H' . $fila)->getCalculatedValue());

        return $linea;
    }

}
