<?php
/**
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

class MigrarLocalizacionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fd:migrar_localizacion')
            ->setDescription('Pasa las ofertas de las unidades educativas a la localizacion de las unidades educativas.')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $logger = $this->getContainer()->get('logger');

        //el container esta disponible con $this->getContainer()->get('ladybug');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        
        $unidades_ofertas = $em->getRepository('EstablecimientoBundle:UnidadOferta')->findBy(array(), array('id'=>'asc'));

        //Se copia el valor localizacion_id referido a unidad_educativa en unidad_oferta
        if ( count($unidades_ofertas) > 1){
            //tienen más de una lozalizacion. Hay que clonar el registro de unidad_oferta
        }else
        {
            //tienen una sola localizacion. 
        }
        
        //salida de pantalla
        $output->writeln('Proceso todo');
    }
}