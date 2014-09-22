<?php

namespace Fd\EStablecimientoBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Sensio\Bundle\GeneratorBundle\Command\Validators;
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;
use Sensio\Bundle\GeneratorBundle\Generator\DoctrineFormGenerator;
use JordiLlonch\Bundle\CrudGeneratorBundle\Generator\DoctrineFormFilterGenerator;

class MigrarUnidadOfertaTurnoCommand extends ContainerAwareCommand
{

    private $em; 
    
    protected function configure()
    {
        $this->setName('oferta_educativa:migrar:unidadoferta_turnos');
        $this->setDescription('Migra datos de turnos_oferta_educativa a unidadoferta_turnos');
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine.orm.entity_manager');
//
//    $turnos[] = [79,	143,	29];
//    $turnos[] = [79,	143,	30];



        try {
            $this->getFormFilterGenerator()->generate($bundle, $entity, $metadata[0]);
        } catch (\RuntimeException $e ) {
            // form already exists
        }
    }
    

}
