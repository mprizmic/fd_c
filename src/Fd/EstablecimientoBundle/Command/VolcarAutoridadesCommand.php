<?php
namespace Fd\EstablecimientoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Fd\EstablecimientoBundle\Entity\Autoridad;
use Fd\TablaBundle\Entity\CargoAutoridad;

class VolcarAutoridadesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('fd:volcar_autoridades')
            ->setDescription('pasa los datos de las autoridades del establecimientos a la tabla autoridad')
//            ->addArgument('name', InputArgument::OPTIONAL, 'Who do you want to greet?')
//            ->addOption('yell', null, InputOption::VALUE_NONE, 'If set, the task will yell in uppercase letters')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('ladybug');

        //el container esta disponible con $this->getContainer()->get('ladybug');
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $establecimientos = $em->getRepository('EstablecimientoBundle:Establecimiento')->findAll();

        foreach ($establecimientos as $establecimiento) {
            ld($establecimiento->getApodo());
            if ($establecimiento->getNombreAutoridad()){
                $autoridad = new Autoridad();
                $autoridad->setNombre($establecimiento->getNombreAutoridad());
                $autoridad->setEstablecimiento($establecimiento);
                $autoridad->setCargoAutoridad($establecimiento->getCargoAutoridad());
                $em->persist($autoridad);
                $em->flush();
                ld($autoridad->getNombre().' id '.$autoridad->getId());
            }
        }
        
        //salida de pantalla
        $output->writeln('proceso todo');
    }
}