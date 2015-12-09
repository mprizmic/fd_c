<?php

namespace Fd\OfertaEducativaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\Respuesta;
use Fd\OfertaEducativaBundle\Entity\OfertaEducativa;
use Fd\OfertaEducativaBundle\Entity\Carrera;
use Fd\OfertaEducativaBundle\Entity\Norma;
use Fd\OfertaEducativaBundle\Model\CarreraManager;
use Fd\OfertaEducativaBundle\Model\OfertaEducativaManager;
use Fd\TablaBundle\Entity\EstadoCarrera;
use Fd\TablaBundle\Model\EstadoCarreraManager;

class PruebaCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
                ->setName('fd:oe:prueba')
                ->setDescription('prueba de cascade para las ofertas educativas')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {

        $logger = $this->getContainer()->get('logger');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        //creo una carrera. La carrera crea la oferta aeducativa
//        $carrera_manager = new CarreraManager($em);
//        $carrera = $carrera_manager->crearNuevo();
//        $carrera = new Carrera();
//        $carrera->setNombre('AAABBB');
//        $carrera_manager->crear($carrera, true);

        $output->write('Carrera: '  .  "\n");
//        $output->write('Carrera: ' . $carrera->getId() . "\n");

        //oferta
//        $oferta_educativa = $carrera->getOferta();
//        $output->write('Oferta: ' . $oferta_educativa->getId() . "\n");

        //asigno normas
//        $norma1 = $em->getRepository('OfertaEducativaBundle:Norma')->find(1);
//        $norma2 = $em->getRepository('OfertaEducativaBundle:Norma')->find(2);
//        $oferta_educativa->addNorma($norma1);
//        $oferta_educativa->addNorma($norma2);
        //persisto oferta
//        $em->persist($oferta_educativa);
//        $em->flush();
//        $oferta_educativa = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find(141);
        
//        $output->write('a borrar' . "\n");
//        $carrera_id = $carrera->getId();
//        $oferta_id = $oferta_educativa->getId();
//        
//        $carrera = $em->getRepository('OfertaEducativaBundle:Carrera')->find($carrera_id);
        
//        $oferta_educativa->setCarrera(null);
//        $em->persist($oferta_educativa);
//        $em->remove($carrera);
//        $em->flush();


        //pruebo lo generado
//        $carrera = $em->getRepository('OfertaEducativaBundle:Carrera')->find($carrera_id);
//        if (!$carrera) {
//            $output->writeln('borrò la carrera ok');
//        };
//        $oferta_educativa = $em->getRepository('OfertaEducativaBundle:OfertaEducativa')->find($oferta_id);
//        if (!$oferta_educativa) {
//            $output->writeln('borrò la oferta ok');
//        }

        //salida de pantalla
        $output->writeln('proceso todo');
    }

}
