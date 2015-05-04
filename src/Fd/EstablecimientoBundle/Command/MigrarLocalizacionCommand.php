<?php

/**
 * 
 * OJO está para correr sólo para la ENS 3
 * 
 * Copiar datos de unidad_educativa a localizacion:
 * Para cada unidad_oferta se debe tomar la unidad_educativa, ver las localizaciones 00
 * y copiar la localizacion en el lugar de la unidad_educativa.
 * En los casos de los anexos habra que corregir a mano
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
    var $logger;

    protected function configure() {
        $this
                ->setName('fd:migrar_localizacion')
                ->setDescription('Pasa las ofertas de las unidades educativas a la localizacion de las unidades educativas.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $logger = $this->getContainer()->get('logger');

//el container esta disponible con $this->getContainer()->get('ladybug');
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

//leo todas las unidades educativas de nivel terciario
//luego proceso cada una de las unidades educativas
//de cada unidad educativa tomo su localizacion 00
//luego busco todas las unidad_oferta que sean de la unidad educativa en proceso y le cargo la localizacion
//si hay mas de una localizacion, quiere decir que hay un anexo. Esto lo voy a resolver a mano

        $unidades_educativas = $this->em->getRepository('EstablecimientoBundle:UnidadEducativa')->findAll();

        foreach ($unidades_educativas as $unidad_educativa) {
            $output->writeln('**********************************************');
            $output->writeln('Unidad_educativa_id: ' . $unidad_educativa->getId());
            $output->writeln('Nivel: ' . $unidad_educativa->getNivel()->getAbreviatura() . ' del: ' . $unidad_educativa->getEstablecimiento());

            //de cada unidad educativa tomo todas sus localizaciones y me quedo con cue_anexo = 00
            $localizaciones = $unidad_educativa->getLocalizaciones();
            $sede = null;
            foreach ($localizaciones as $localizacion) {
                if ($localizacion->getEstablecimientoEdificio()->isSede()) {
                    $sede = $localizacion;
                    break;
                }
            }

            //Si tiene hecha la asignacion a la sede continua y sino salta al proximo
            if ($sede) {
//                $output->writeln('Localizacion: ' . $sede);
//
////            luego busco todas las unidad_oferta que sean de la unidad educativa en proceso y le cargo la localizacion
//                $unidades_ofertas = $this->em
//                        ->getRepository('EstablecimientoBundle:UnidadOferta')
//                        ->findBy(array(
//                    'unidades' => $unidad_educativa->getId(),
//                        ), array(
//                    'id' => 'asc',
//                        ))
//                ;
//
//                //se copia la localizacion en cada una de las unidades oferta
//                foreach ($unidades_ofertas as $unidad_oferta) {
//
//                    $output->writeln('Unidad_oferta_id: ' . $unidad_oferta->getId());
//
//                    $this->asignar_localizacion($unidad_educativa, $sede, $output);
//                    $output->writeln('asigno localizacion ' . $localizacion->getId());
//                }
                
                
                
            
                    
                    
                    
                    
            } else {
                $output->writeln('Localizacion: NO TIENE CARGADA');
            }
        }
//        //salida de pantalla
        $output->writeln('//////////////////////////////////////////////');
        $output->writeln('//////////////////////////////////////////////');
        $output->writeln('Proceso todo');
    }

    public function asignar_localizacion($unidad_oferta, Localizacion $localizacion, $output) {
//        $unidad_oferta->setLocalizacion($localizacion);
//        $this->em->persist($unidad_oferta);
//        $this->em->flush();
//        $output->writeln('GRABO: ' . $unidad_oferta . ' - ' . $localizacion);
    }

}
