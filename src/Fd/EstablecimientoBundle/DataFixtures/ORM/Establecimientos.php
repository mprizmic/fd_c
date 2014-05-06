<?php

namespace Fd\EstablecimientoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\EstablecimientoBundle\Entity\Establecimiento;
use Fd\TablaBundle\Entity\Sector;
use Fd\TablaBundle\Entity\DistritoEscolar;

class Establecimientos extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
        //ens 1
        $hoy = new \DateTime();
        $entity = new Establecimiento();
        $entity->setCue('02123456');
        /*
         * esta entrada es de uno a muchos así que no se si iria un loop 
         * para setear la colleccion de edificios
         */
//        $entity->setEdificio($manager->merge($this->getReference('ENS 100')));
        $entity->setCodigoPrevioTransferencia('aaa');
        $entity->setNombre('ENS 1 Roque Saenz Peña');
        $entity->setApodo('ENS 1');
        $entity->setNumero(1);
        $entity->setDescripcion('ENS 1');
        $entity->setFechaCreacion($hoy);
        $entity->setTieneCooperadora(true);
        $entity->setConveniado(true);
        $entity->setObsConvenio('observaciones del convenio x');
        $entity->setDistritoEscolar($manager->merge($this->getReference('distrito1')));
        $entity->setSector($manager->merge($this->getReference('Estatal')));
        $entity->setEmail('ens1@bue.edu.ar');
        $entity->setUrl('http://ens1de1.buenosaires.edu.ar');
        
        $manager->persist($entity);

        $this->addReference($entity->getApodo(), $entity);

        //ens 8
        $hoy = new \DateTime('today');
        $entity = new Establecimiento();
        $entity->setCue('02123457');
//        $entity->setEdificio($manager->merge($this->getReference('ENS 800')));
        $entity->setCodigoPrevioTransferencia('aaa2');
        $entity->setNombre('Escuela Normal Superior Nº 8 Julio Argentino Roca');
        $entity->setApodo('ENS 8');
        $entity->setNumero(8);
        $entity->setDescripcion('ENS 8');
        $entity->setFechaCreacion($hoy);
        $entity->setTieneCooperadora(true);
        $entity->setConveniado(false);
        $entity->setDistritoEscolar($manager->merge($this->getReference('distrito4')));
        $entity->setSector($manager->merge($this->getReference('Estatal')));
        $entity->setEmail('ens8@bue.edu.ar');
        $entity->setUrl('http://ens8de6.buenosaires.edu.ar/ens8.htm');
        
        
        $manager->persist($entity);
        
        $this->addReference($entity->getApodo(), $entity);

        $manager->flush();
       
    }

    public function getOrder() {
        return 200;
    }
}
?>
