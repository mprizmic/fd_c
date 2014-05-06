<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\TipoTrayecto;

class TipoTrayectos extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new TipoTrayecto();
        $entity->setCodigo('TFG');
        $entity->setDescripcion('Trayecto de formación general');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new TipoTrayecto();
        $entity->setCodigo('TFE');
        $entity->setDescripcion('Trayecto de formación específica');
        $entity->setOrden(2);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new TipoTrayecto();
        $entity->setCodigo('TCPD');
        $entity->setDescripcion('Trayecto de construcción de la práctica docente');
        $entity->setOrden(3);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

                $entity = new TipoTrayecto();
        $entity->setCodigo('CFG');
        $entity->setDescripcion('Campo de formación general');
        $entity->setOrden(4);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new TipoTrayecto();
        $entity->setCodigo('CFE');
        $entity->setDescripcion('Campo de formación específica');
        $entity->setOrden(5);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new TipoTrayecto();
        $entity->setCodigo('CFPD');
        $entity->setDescripcion('Campo de formación de la práctica docente');
        $entity->setOrden(6);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
            
    }

    public function getOrder() {
        return 245;
    }
}
?>
