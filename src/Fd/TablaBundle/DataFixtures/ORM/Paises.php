<?php

namespace Fd\TablaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Fd\TablaBundle\Entity\Pais;

class Paises extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface {
   
    public function load(ObjectManager $manager) {
              
        $entity = new Pais();
        $entity->setCodigo('AR');
        $entity->setDescripcion('Argentina');
        $entity->setOrden(1);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Pais();
        $entity->setCodigo('UR');
        $entity->setDescripcion('Uruguay');
        $entity->setOrden(2);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
        
        $entity = new Pais();
        $entity->setCodigo('AS');
        $entity->setDescripcion('Asia');
        $entity->setOrden(3);
        $this->addReference($entity->getCodigo(), $entity);
        $manager->persist($entity);
        $manager->flush();
       
    }

    public function getOrder() {
        return 200;
    }
}
?>
