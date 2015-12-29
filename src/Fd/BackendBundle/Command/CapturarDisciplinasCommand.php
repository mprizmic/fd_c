<?php

/**
 * sf fd:disciplina:capturar --archivo=xx.xls --force
 * 
 */

namespace Fd\BackendBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\UnidadOfertaTurno;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\Disciplina;
use Fd\OfertaEducativaBundle\Model\CarreraManager;

class CapturarDisciplinasCommand extends ContainerAwareCommand {

    public $planilla;

    protected function configure() {
        $this
                ->setName('fd:disciplina:capturar')
                ->setDescription('Captura un excel con disciplinas de las carreras')
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

        $output->writeln($flush ? '***********************************graba' : '********************************NO GRABA');



        //el container esta disponible con $this->getContainer()->get('servicio');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        //Ruta hasta la capeta del proyecto
        $targetDir = $this->getContainer()->getParameter('kernel.root_dir') . '/../web/uploads/';

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

        $fila = 1;

        //creo manejadores

        $linea = $this->leer($fila);

        while ($fila <= $highestRow) {


            $carrera = $em->getRepository('OfertaEducativaBundle:Carrera')
                    ->findOneBy(array(
                'nombre' => $linea['carrera'],
            ));

            if (!$carrera) {
                $output->writeln('No existe el nombre de la carrera: ' . $linea['carrera']);
//                die();
            } else {

                //existe la carrera
                $tiene_disciplina = $carrera->getDisciplina() ? true : false;


                if (!$tiene_disciplina) {
                    //ver si existe la disciplina
                    $disciplina = $em->getRepository('OfertaEducativaBundle:Disciplina')
                            ->findOneBy(array(
                        'codigo' => $linea['codigo']
                    ));

                    if (!$disciplina) {
                        //generar registro de disciplina
                        $disciplina = new Disciplina();
                        $disciplina->setCodigo($linea['codigo']);
                        $disciplina->setDescripcion($linea['disciplina']);
                        $em->persist($disciplina);

                        if ($flush) {
                            $em->flush();
                        }

                        $output->writeln('**************graba disciplina: ' . $linea['codigo']);
                    }

                    //grabar la disciplina en la carrera
                    $carrera->setDisciplina($disciplina);
                    $em->persist($carrera);

                    if ($flush) {
                        $em->flush();
                    }

                    $output->writeln('**************graba carrera: ' . $linea['carrera']);
                }
            }

            //leo fila siguiente
            $fila = $fila + 1;
            $linea = $this->leer($fila);
        }

        $output->writeln('terminó y procesó');

        return;
    }

    /**
     * Lee de a una celda y carga en un array
     */
    private function leer($fila) {

        $linea['carrera'] = trim($this->planilla->getCell('A' . $fila)->getCalculatedValue());
        $linea['disciplina'] = trim($this->planilla->getCell('B' . $fila)->getCalculatedValue());
        $linea['codigo'] = trim($this->planilla->getCell('C' . $fila)->getCalculatedValue());

        return $linea;
    }

}
