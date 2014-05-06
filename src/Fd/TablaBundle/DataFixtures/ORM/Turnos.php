<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Turno;

class Turnos extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Turno();
        $entity->setCodigo('TM');
        $entity->setDescripcion('Mañana');
        $entity->setOrden(1);
        $this->addReference($entity->getDescripcion(), $entity);
        $manager->persist($entity);
        $manager->flush();

        $entity = new Turno();
        $entity->setCodigo('TT');
        $entity->setDescripcion('Tarde');
        $entity->setOrden(2);
        $this->addReference($entity->getDescripcion(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Turno();
        $entity->setCodigo('TV');
        $entity->setDescripcion('Vespertino');
        $entity->setOrden(3);
        $this->addReference($entity->getDescripcion(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Turno();
        $entity->setCodigo('NA');
        $entity->setDescripcion('No aplica');
        $entity->setOrden(4);
        $this->addReference($entity->getDescripcion(), $entity);
        $manager->persist($entity);
        $manager->flush();

    }

    public function getOrder() {
        return 170;
    }
}
?>
