<?php

/**
 * 
 * Poner a cada unidad_oferta el tipo
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
use Fd\EstablecimientoBundle\Utilities\TipoUnidadOferta;

class CargarTipoUnidadOfertaCommand extends ContainerAwareCommand {

    var $em;
    var $logger;

    protected function configure() {
        $this
                ->setName('fd:cargar:tuo')
                ->setDescription('Cargar los tipos de unidad oferta a las unidad oferta del servidor')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        
        $logger = $this->getContainer()->get('logger');

        //el container esta disponible con $this->getContainer()->get('ladybug');
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $unidad_ofertas = $this->em->getRepository('EstablecimientoBundle:UnidadOferta')
                ->findAll();
        
        foreach ($unidad_ofertas as $unidad_oferta) {
            $output->writeln('**********************************************');
            $output->writeln('Unidad_oferta_id: ' . $unidad_oferta->getId());
            $output->writeln( $unidad_oferta->__toString() );

            $tipo = $unidad_oferta->getOfertas()->esTipo();
            
            $output->writeln('Tipo: ' . $tipo);
            
            if ( empty($unidad_oferta->getTipo())){
                
                $unidad_oferta->setTipo($tipo);
                $this->em->persist($unidad_oferta);
            }
            
        }
        $this->em->flush();
//        //salida de pantalla
        $output->writeln('//////////////////////////////////////////////');
        $output->writeln('//////////////////////////////////////////////');
        $output->writeln('Proceso todo');
    }

    public function asignar_tipo($unidad_oferta, Localizacion $localizacion, $output) {
//        $unidad_oferta->setLocalizacion($localizacion);
//        $this->em->persist($unidad_oferta);
//        $this->em->flush();
//        $output->writeln('GRABO: ' . $unidad_oferta . ' - ' . $localizacion);
    }

}
