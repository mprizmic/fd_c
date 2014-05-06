<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Provincia;

class Provincias extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Provincia();
        $entity->setCodigo('CABA');
        $entity->setDescripcion('CABA');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new Provincia();
        $entity->setCodigo('CBA');
        $entity->setDescripcion('Córdoba');
        $entity->setOrden(2);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
              
        $entity = new Provincia();
        $entity->setCodigo('MSN');
        $entity->setDescripcion('Misiones');
        $entity->setOrden(3);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();

       
    }

    public function getOrder() {
        return 210;
    }
}
?>
