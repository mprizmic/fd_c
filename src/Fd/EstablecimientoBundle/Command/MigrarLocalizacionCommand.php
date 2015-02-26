<?php

/**
 * 
 * OJO está para correr sólo para la ENS 3
 * 
 * Copiar datos de unidad_educativa a localizacion:
 * para cada unidad_oferta se debe tomar la unidad_educativa, ver todas sus localizaciones 
 * y copiar la localizacion en el lugar de la unidad_educativa.
 * Si hay mas de una localizacion se deben generar nuevos registros en unidad_oferta.
 * 
 * Este comando se corre para que las ofertas en vez de estar asociadas a una unidad educativa estén asociadas al lugar en donde se dictan.
 * Esto va a permitir hacer la matricula por sede y los titulos por sedes.
 */

namespace Fd\EstablecimientoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\UnidadEducativa;
use Fd\EstablecimientoBundle\Entity\UnidadOferta;
use Fd\EstablecimientoBundle\Entity\Localizacion;

class MigrarLocalizacionCommand extends ContainerAwareCommand {

    var $em;

    protected function configure() {
        $this
                ->setName('fd:migrar_localizacion')
                ->setDescription('Pasa las ofertas de las unidades educativas a la localizacion de las unidades educativas.')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $logger = $this->getContainer()->get('logger');

        //el container esta disponible con $this->getContainer()->get('ladybug');
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        //leo todas las unidades educativas de nivel terciario
        //luego proceso cada una de las unidades educativas
        //de cada unidad educativa tomo todas sus localizaciones
        //luego busco todas las unidad_oferta que sean de la unidad educativa en proceso y le cargo la localizacion
        //si hay mas de una localizacion, entonces genero duplicado de todos los registros de unidad_oferta para las localizaciones a partir de la segunda

        $unidades_educativas = $this->em->getRepository('EstablecimientoBundle:UnidadEducativa')->findBy(array('nivel' => 32), array('id' => 'asc'));

        foreach ($unidades_educativas as $unidad_educativa) {
            $output->writeln('Unidad_educativa_id: ' . $unidad_educativa->getId());

            //de cada unidad educativa tomo todas sus localizaciones
            $localizaciones = $unidad_educativa->getLocalizaciones();

            //luego busco todas las unidad_oferta que sean de la unidad educativa en proceso y le cargo la localizacion
            $unidades_ofertas = $this->em->getRepository('EstablecimientoBundle:UnidadOferta')->findBy(array('unidades' => $unidad_educativa->getId()), array('id' => 'asc'));

            //se copia la localizacion en cada una de las unidades oferta
            foreach ($unidades_ofertas as $unidad_oferta) {

                $output->writeln('Unidad_oferta_id: ' . $unidad_oferta->getId());

                foreach ($localizaciones as $key => $localizacion) {
                    if ($key <> 0) {

                        //duplico el registro
                        $duplicado = new UnidadOferta();
                        $duplicado->setUnidades($unidad_oferta->getUnidades());
                        $duplicado->setOfertas($unidad_oferta->getOfertas());

                        //puede no tener turnos o no ser los mismos para todas las localizaciones
//                        if (!is_null($unidad_oferta->getTurnos())) {
//                            $duplicado->setTurnos($unidad_oferta->getTurnos());
//                        }

                        $output->writeln('duplicado creado');
                        $output->writeln('asigno localizacion' . $localizacion->getId());

                        $this->asignar_localizacion($duplicado, $localizacion);
                    } else {
                        $this->asignar_localizacion($unidad_oferta, $localizacion);
                        $output->writeln('asigno localizacion ' . $localizacion->getId());
                    }
                };
            };
        }

        //salida de pantalla
        $output->writeln('Proceso todo');
    }

    protected function asignar_localizacion(UnidadOferta $unidad_oferta, Localizacion $localizacion) {
        $unidad_oferta->setLocalizacion($localizacion);
        $this->em->persist($unidad_oferta);
        $this->em->flush();
    }

}
