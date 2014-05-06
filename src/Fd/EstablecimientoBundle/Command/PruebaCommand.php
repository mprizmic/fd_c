<?php

namespace Fd\EstablecimientoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\OfertaEducativaBundle\Entity\Cohorte;

class PruebaCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('fd:prueba')
                ->setDescription('prueba de cualquier cosa')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->getContainer()->get('ladybug');

        //el container esta disponible con $this->getContainer()->get('ladybug');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $repo = $em->getRepository('EstablecimientoBundle:UnidadOferta');
        $unidad_ofertas = $repo->findCarrerasConCohortes(26);


        $unidad_oferta = $unidad_ofertas[0];
        $cohortes = $unidad_oferta->getCohortes();

        foreach ($cohortes as $value=>$key) {
//            $arr = get_object_vars($cohorte);
//            ld('valor '.$value);
//            ld('clave '.$key);
            $arr[$key->getAnio()] = array($key->getMatricula(), $key->getDesgranamiento());
//            $output->writeln('año ' . $cohorte->getAnio());
//            $output->writeln('matricula ' . $cohorte->getMatricula());
        }
            ksort($arr);
            ld($arr);
//        
        //salida de pantalla
        $output->writeln('proceso todo');
    }

    function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {
        $arrData = array();

        // if input is object, convert into array
        if (is_object($arrObjData)) {
            $arrObjData = get_object_vars($arrObjData);
        }

        if (is_array($arrObjData)) {
            foreach ($arrObjData as $index => $value) {
                if (is_object($value) || is_array($value)) {
                    $value = objectsIntoArray($value, $arrSkipIndices);
                }
                if (in_array($index, $arrSkipIndices)) {
                    continue;
                }
                $arrData[$index] = $value;
            }
        }
        return $arrData;
    }

}